<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Support;
use App\Models\Reward;
use App\Models\Order;
use App\Models\Supporter;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\PurchaseCompleted;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Project $project)
    {
        if (!$project->isActive()) {
            return redirect()->route('projects.show', $project)
                ->with('error', 'このプロジェクトは支援期間が終了しています。');
        }

        $rewards = $project->rewards;
        \Log::info('Found rewards for project: ' . json_encode($rewards->toArray()));

        return view('purchase.create', compact('project', 'rewards'));
    }

    public function store(Request $request, Project $project)
    {
        // セッションデータの検証
        $purchaseData = $request->session()->get('purchase');
        if (!$purchaseData) {
            \Log::error('Purchase session data not found');
            return redirect()->route('purchase.create', ['project' => $project])
                ->withErrors(['error' => '支援情報が見つかりません。最初からやり直してください。']);
        }

        if ($purchaseData['project_id'] != $project->id) {
            \Log::error('Project ID mismatch in session', [
                'session_project_id' => $purchaseData['project_id'],
                'route_project_id' => $project->id
            ]);
            return redirect()->route('purchase.create', ['project' => $project])
                ->withErrors(['error' => 'プロジェクト情報が一致しません。最初からやり直してください。']);
        }

        $user = auth()->user();
        if (!$user) {
            \Log::error('User not authenticated');
            return redirect()->route('login')
                ->withErrors(['error' => 'ログインが必要です。']);
        }

        \Log::info('Starting Stripe checkout process', [
            'user_id' => $user->id,
            'project_id' => $project->id,
            'purchase_data' => $purchaseData
        ]);

        try {
            // Stripeの決済セッションを作成
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => $project->title . 'への支援',
                        ],
                        'unit_amount' => $purchaseData['amount'],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => url('/projects/' . $project->id . '/purchase/success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => url('/projects/' . $project->id . '/purchase/cancel'),
                'metadata' => [
                    'project_id' => $project->id,
                    'user_id' => $user->id,
                    'reward_id' => $purchaseData['reward_id'] ?? '',
                    'amount' => $purchaseData['amount'],
                ],
            ]);

            \Log::info('Stripe session created', ['session_id' => $session->id]);

            // Stripeのチェックアウトページにリダイレクト
            return redirect($session->url);

        } catch (\Exception $e) {
            \Log::error('Stripe checkout creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('purchase.create', ['project' => $project])
                ->withErrors(['error' => '決済処理の開始に失敗しました。もう一度お試しください。']);
        }
    }

    public function success(Request $request, Project $project)
    {
        $sessionId = $request->query('session_id');
        
        if (!$sessionId) {
            \Log::error('No session ID provided');
            return redirect()->route('projects.show', $project)
                ->with('error', '決済情報が見つかりません。');
        }

        try {
            // Stripeセッションを取得
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            
            if ($session->payment_status !== 'paid') {
                \Log::error('Payment not completed', ['session_id' => $sessionId]);
                return redirect()->route('projects.show', $project)
                    ->with('error', '決済が完了していません。');
            }

            $user = auth()->user();
            if (!$user) {
                \Log::error('User not authenticated');
                return redirect()->route('login')
                    ->withErrors(['error' => 'ログインが必要です。']);
            }

            \DB::beginTransaction();

            // 支援情報を作成
            $support = Support::create([
                'user_id' => $user->id,
                'project_id' => $project->id,
                'reward_id' => $session->metadata->reward_id ?? null,
                'amount' => $session->metadata->amount,
                'status' => 'completed',
                'supported_at' => now(),
            ]);

            \Log::info('Support created', ['support_id' => $support->id]);

            // 注文情報を作成
            $orderData = [
                'order_date' => now(),
                'last_name' => $user->last_name ?? '匿名',
                'first_name' => $user->first_name ?? 'サポーター',
                'last_name_kana' => $user->last_name_kana ?? 'トクメイ',
                'first_name_kana' => $user->first_name_kana ?? 'サポーター',
                'phone_number' => $user->phone_number ?? '000-0000-0000',
                'email' => $user->email,
                'postal_code' => $user->postal_code ?? '000-0000',
                'prefecture' => $user->prefecture ?? '東京都',
                'city' => $user->city ?? '新宿区',
                'address' => $user->address ?? 'サンプル1-1-1',
                'building_name' => $user->building_name ?? '',
                'terms_agreement' => true,
                'payment_status' => 1, // 支払い完了
                'charge_id' => $session->payment_intent,
                'session_id' => $sessionId,
                'user_id' => $user->id,
                'supporter_id' => null,
                'amount' => $session->metadata->amount,
                'project_id' => $project->id,
                'reward_id' => $session->metadata->reward_id ?? null,
            ];

            $order = Order::create($orderData);
            \Log::info('Order created', ['order_id' => $order->order_id]);

            \DB::commit();

            // メール送信（購入者と管理者の両方に送信）
            try {
                // 購入者に決済完了メールを送信
                Mail::to($order->email)->send(new PurchaseCompleted($order));
                \Log::info('Purchase completion email sent to buyer', ['email' => $order->email]);
                
                // 管理者にも通知を送信
                Mail::to('uknight.sc@hachiouji-uknight.com')->send(new PurchaseCompleted($order));
                \Log::info('Purchase completion email sent to admin', ['email' => 'uknight.sc@hachiouji-uknight.com']);
            } catch (\Exception $e) {
                \Log::error('Failed to send purchase completion email', ['error' => $e->getMessage()]);
            }

            // セッションをクリア
            $request->session()->forget('purchase');

            return redirect()->route('purchase.complete', ['project' => $project])
                ->with('success', '支援が完了しました！ありがとうございます。');

        } catch (\Exception $e) {
            \DB::rollBack();
            \Log::error('Payment success processing failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('projects.show', $project)
                ->with('error', '決済処理に失敗しました。サポートにお問い合わせください。');
        }
    }

    public function cancel(Project $project)
    {
        return redirect()->route('projects.show', $project)
            ->with('error', '決済がキャンセルされました。');
    }

    public function complete(Project $project)
    {
        return view('purchase.complete', compact('project'));
    }

    public function confirm(Request $request, Project $project)
    {
        if (!$project->isActive()) {
            return redirect()->route('projects.show', $project)
                ->with('error', 'このプロジェクトは支援期間が終了しています。');
        }

        // GETリクエストの場合、確認画面を表示
        if ($request->isMethod('get')) {
            $purchaseData = $request->session()->get('purchase');
            if (!$purchaseData) {
                return redirect()->route('purchase.create', ['project' => $project])
                    ->with('error', '支援情報が見つかりません。最初からやり直してください。');
            }

            $reward = null;
            if (!empty($purchaseData['reward_id'])) {
                $reward = Reward::where('reward_id', $purchaseData['reward_id'])->first();
            }

            return view('purchase.confirm', [
                'project' => $project,
                'reward' => $reward,
                'amount' => $purchaseData['amount'],
            ]);
        }

        // POSTリクエストの場合、バリデーションとセッション保存
        \Log::info('Purchase confirm request:', [
            'all' => $request->all(),
            'reward_id' => $request->input('reward_id'),
            'amount' => $request->input('amount'),
        ]);

        $validated = $request->validate([
            'reward_id' => 'nullable|exists:rewards,reward_id',
            'amount' => 'required|integer|min:1000|max:1000000',
            'agree_terms' => 'required|accepted',
        ], [
            'reward_id.exists' => '選択されたリワードは存在しません。',
            'amount.min' => '支援金額は1,000円以上を入力してください。',
            'amount.max' => '支援金額は1,000,000円以下で入力してください。',
            'agree_terms.required' => '利用規約への同意が必要です。',
            'agree_terms.accepted' => '利用規約に同意してください。',
        ]);

        $reward = null;
        if (!empty($validated['reward_id'])) {
            $reward = Reward::where('reward_id', $validated['reward_id'])->firstOrFail();
            if ($validated['amount'] < $reward->price_incl_tax) {
                return back()
                    ->withInput()
                    ->withErrors(['amount' => 'リワードの金額以上の支援金額を入力してください。']);
            }
            \Log::info('Selected reward:', [
                'reward_id' => $reward->reward_id,
                'price' => $reward->price_incl_tax
            ]);
        }

        // セッションに保存
        $request->session()->put('purchase', [
            'project_id' => $project->id,
            'reward_id' => $validated['reward_id'] ?? null,
            'amount' => $validated['amount'],
            'agree_terms' => true,
        ]);

        \Log::info('confirm blade amount', ['amount' => $validated['amount']]);
        \Log::info('Purchase confirm session saved:', [
            'session' => $request->session()->get('purchase'),
            'reward' => $reward ? $reward->toArray() : null,
        ]);

        return view('purchase.confirm', [
            'project' => $project,
            'reward' => $reward,
            'amount' => $validated['amount'],
        ]);
    }
}
