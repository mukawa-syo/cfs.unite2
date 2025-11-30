<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $user = $request->user();

        // アカウントが無効化されている場合
        if (!$user->is_active) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'このアカウントは無効化されています。');
        }

        // アカウントが一時的にBANされている場合
        if ($user->banned_until && $user->banned_until > now()) {
            auth()->logout();
            return redirect()->route('login')->with('error', 'このアカウントは一時的に利用制限されています。');
        }

        // ロールチェック
        if (!in_array($user->role, $roles)) {
            abort(403, 'このページにアクセスする権限がありません。');
        }

        // パーミッションチェック
        if ($user->permissions) {
            $permissions = json_decode($user->permissions, true);
            $requiredPermissions = $request->route()->getAction('permissions', []);
            
            foreach ($requiredPermissions as $permission) {
                if (!in_array($permission, $permissions)) {
                    abort(403, 'この操作を実行する権限がありません。');
                }
            }
        }

        return $next($request);
    }
}
