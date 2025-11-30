<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\LoginHistory;
use Illuminate\Support\Facades\Auth;

class RecordLoginHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 先にレスポンスを取得
        $response = $next($request);

        // ログインが成功した場合のみ記録
        if ($request->is('login') && $request->isMethod('post') && Auth::check()) {
            $user = Auth::user();
            
            // ユーザーの最終ログイン情報を更新
            $user->last_login_at = now();
            $user->last_login_ip = $request->ip();
            $user->save();

            // ログイン履歴を記録
            LoginHistory::create([
                'user_id' => $user->id,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'login_method' => 'password',
                'is_successful' => true,
                'login_at' => now(),
            ]);
        }

        return $response;
    }
}
