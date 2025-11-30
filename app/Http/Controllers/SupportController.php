<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Support\Facades\DB;

class SupportController extends Controller
{
    public function index()
    {
        $supports = Support::all();
        return view('supports.index', compact('supports'));
    }

    public function create()
    {
        return view('supports.create');
    }

    public function store(Request $request)
    {
        $support = new Support($request->all());
        $support->save();
        return redirect()->route('supports.index');
    }

    public function show(Support $support)
    {
        return view('supports.show', compact('support'));
    }

    public function edit(Support $support)
    {
        return view('supports.edit', compact('support'));
    }

    public function update(Request $request, Support $support)
    {
        $support->update($request->all());
        return redirect()->route('supports.index');
    }

    public function destroy(Support $support)
    {
        $support->delete();
        return redirect()->route('supports.index');
    }

    public function checkout(Request $request)
    {
        \Log::info('checkout request', [
            'amount' => $request->input('amount'),
            'reward_name' => $request->input('reward_name'),
            'all' => $request->all(),
        ]);
        try {
            // プロジェクトIDをリクエストから取得
            $project_id = $request->input('project_id');
            $reward_id = $request->input('reward_id');

            if (!$project_id) {
                \Log::error('Project ID not found in request');
                return back()->with('error', 'プロジェクト情報が見つかりません。');
            }

            Stripe::setApiKey(config('services.stripe.secret'));

            $amount = (int) str_replace(',', '', $request->input('amount'));
            $rewardName = $request->input('reward_name', 'クラファン支援'); // デフォルト名

            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => $rewardName,
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => url('/checkout/success') . '?amount=' . $amount . '&project_id=' . $project_id . '&reward_id=' . ($reward_id ?? ''),
                'cancel_url' => url('/checkout/cancel'),
                'metadata' => [
                    'project_id' => $project_id,
                    'reward_id' => $reward_id ?? '',
                    'amount' => $amount,
                ],
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            \Log::error('Stripe Checkout Error: ' . $e->getMessage());
            return back()->with('error', '決済処理でエラーが発生しました: ' . $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        $user = auth()->user();
        $amount = $request->input('amount');
        $project_id = $request->input('project_id'); // URLパラメータから取得
        $reward_id = $request->input('reward_id'); // URLパラメータから取得

        if (!$project_id) {
            \Log::error('Project ID not found in success callback');
            return redirect()->route('projects.index')->with('error', '処理に失敗しました。プロジェクトIDが見つかりません。');
        }

        try {
            DB::beginTransaction();

            // Orderを新規作成
            $order = \App\Models\Order::create([
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
                'payment_status' => 1,
                'charge_id' => null,
                'session_id' => $request->session()->getId(),
                'user_id' => $user->id,
                'supporter_id' => null, // supportersテーブルとの外部キー制約を回避
                'amount' => $amount,
                'project_id' => $project_id,
                'reward_id' => $reward_id,
            ]);

            // 支援データも作成
            \App\Models\Support::create([
                'user_id' => $user->id,
                'project_id' => $project_id,
                'amount' => $amount,
                'status' => 'completed',
                'supported_at' => now(),
            ]);

            DB::commit();
            
            \Log::info('Support completed successfully', [
                'project_id' => $project_id,
                'amount' => $amount,
                'user_id' => $user->id,
            ]);

            // メール送信
            if ($user && $order) {
                try {
                    \Mail::to($user->email)->send(new \App\Mail\PurchaseCompleted($order));
                } catch (\Exception $e) {
                    \Log::error('Mail send failed after Stripe checkout: ' . $e->getMessage());
                }
            }

            // セッションデータをクリア
            $request->session()->forget(['project_id', 'reward_id']);

            return redirect()->route('projects.show', $project_id)->with('success', '支援が完了しました！ありがとうございます。');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Stripe success process failed: ' . $e->getMessage());
            return redirect()->route('projects.show', $project_id)->with('error', '処理に失敗しました。サポートにお問い合わせください。');
        }
    }

    public function cancel()
    {
        return view('checkout.cancel');
    }
}
