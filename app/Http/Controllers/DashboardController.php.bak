<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\ProjectUpdate;
use App\Models\Support;
use App\Models\Order; // Orderモデルを追加
use App\Models\Supporter;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        \Log::info('Dashboard accessed by user: ' . $user->id);
        
        // ユーザーのプロジェクト一覧を取得
        $projects = Project::where('user_id', $user->id)
                         ->get();

        // 統計情報を取得
        $totalSupporters = $projects->sum('supporters_count');
        $totalPledged = $projects->sum('total_pledge_amount');
        $updates = ProjectUpdate::whereIn('project_id', $projects->pluck('id'))->count();

        // 最近の支援履歴を取得
        $recentSupports = Support::where('user_id', $user->id)
            ->with(['project', 'reward'])
            ->orderBy('supported_at', 'desc')
            ->take(3)
            ->get();
        \Log::info('Recent supports count: ' . $recentSupports->count());

        // 最近の注文履歴を取得
        $recentOrders = Order::where('user_id', $user->id)
            ->with(['user'])
            ->orderBy('order_date', 'desc')
            ->take(3)
            ->get();
        \Log::info('Recent orders count: ' . $recentOrders->count());

        // 最近の活動を取得（プロジェクトの更新、支援の受け取りなど）
        $recentActivities = collect();

        // プロジェクトの更新を追加
        $projectUpdates = ProjectUpdate::whereIn('project_id', $projects->pluck('id'))
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($update) {
                return (object)[
                    'description' => "プロジェクト「{$update->project->project_name}」にアップデートを投稿しました。",
                    'created_at' => $update->created_at
                ];
            });
        $recentActivities = $recentActivities->concat($projectUpdates);

        // 受け取った支援を追加
        $recentProjectSupports = Support::whereIn('project_id', $projects->pluck('id'))
            ->with(['project', 'user'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($support) {
                $userName = $support->user ? $support->user->name : '匿名';
                return (object)[
                    'description' => "プロジェクト「{$support->project->project_name}」が{$userName}さんから¥" . number_format($support->amount) . "の支援を受けました。",
                    'created_at' => $support->created_at
                ];
            });
        $recentActivities = $recentActivities->concat($recentProjectSupports);

        // 活動を日時順にソートして最新5件を取得
        $recentActivities = $recentActivities->sortByDesc('created_at')->take(5);

        return view('dashboard', compact(
            'projects',
            'totalSupporters',
            'totalPledged',
            'updates',
            'recentActivities',
            'recentSupports',
            'recentOrders'
        ));
    }

    public function purchaseHistory()
    {
        $user = auth()->user();
        \Log::info('User ID: ' . $user->id);

        // ユーザーの注文履歴を取得
        $orders = Order::where('user_id', $user->id)
            ->with(['user'])
            ->orderBy('order_date', 'desc')
            ->get();
            
        \Log::info('Orders count: ' . $orders->count());
        \Log::info('Orders: ' . $orders->toJson());

        // ユーザーの支援履歴も取得
        $supports = Support::where('user_id', $user->id)
            ->with(['project', 'reward'])
            ->orderBy('supported_at', 'desc')
            ->get();

        \Log::info('Supports count: ' . $supports->count());
        \Log::info('Supports: ' . $supports->toJson());

        return view('purchase.purchaseHistory', compact('orders', 'supports'));
    }

    public function editProfile()
    {
        $user = auth()->user();
        return view('dashboard.profile.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        \Log::info('Profile update started for user: ' . $user->id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'postal_code' => 'nullable|string|max:8',
            'prefecture' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'building_name' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'current_password' => $request->filled('new_password') ? 'required|current_password' : '',
            'new_password' => 'nullable|string|min:8|confirmed',
        ], [
            'current_password.current_password' => '現在のパスワードが正しくありません。',
            'new_password.min' => '新しいパスワードは8文字以上で入力してください。',
            'new_password.confirmed' => '新しいパスワードと確認用パスワードが一致しません。',
        ]);

        \Log::info('Current user data:', [
            'name' => $user->name,
            'email' => $user->email,
            'postal_code' => $user->postal_code,
            'prefecture' => $user->prefecture,
            'city' => $user->city,
            'address' => $user->address,
            'building_name' => $user->building_name,
            'phone_number' => $user->phone_number,
        ]);
        \Log::info('Validated new data:', $validated);

        // 変更された項目を追跡
        $changedFields = [];
        $fieldsToCheck = [
            'name', 'email', 'postal_code', 'prefecture', 'city', 
            'address', 'building_name', 'phone_number'
        ];

        foreach ($fieldsToCheck as $field) {
            $oldValue = $user->{$field};
            $newValue = $validated[$field] ?? null;
            
            // null と空文字列を同等として扱う
            $oldValueNormalized = $oldValue === null ? '' : (string)$oldValue;
            $newValueNormalized = $newValue === null ? '' : (string)$newValue;
            
            if ($oldValueNormalized !== $newValueNormalized) {
                $changedFields[$field] = $newValue;
                \Log::info("Field '{$field}' changed from '{$oldValueNormalized}' to '{$newValueNormalized}'");
            }
        }

        // パスワード以外の情報を更新
        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'postal_code' => $validated['postal_code'],
            'prefecture' => $validated['prefecture'],
            'city' => $validated['city'],
            'address' => $validated['address'],
            'building_name' => $validated['building_name'],
            'phone_number' => $validated['phone_number'],
        ]);

        // パスワードが入力されている場合は更新
        if ($request->filled('new_password')) {
            $user->password = bcrypt($validated['new_password']);
            $changedFields['password'] = '********';
            \Log::info('Password change detected');
        }

        $user->save();

        // 変更された項目がある場合のみ通知を送信
        if (!empty($changedFields)) {
            \Log::info('Sending notification for changed fields:', $changedFields);
            try {
                $user->notify(new \App\Notifications\ProfileUpdated($user, $changedFields));
                \Log::info('Notification sent successfully');
            } catch (\Exception $e) {
                \Log::error('Failed to send notification: ' . $e->getMessage());
            }
        } else {
            \Log::info('No fields changed, skipping notification');
        }

        return redirect()->route('dashboard')
            ->with('success', 'プロフィールを更新しました。');
    }
}
