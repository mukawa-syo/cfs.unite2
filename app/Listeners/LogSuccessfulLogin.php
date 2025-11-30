<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\LoginHistory;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        
        // ユーザーの最終ログイン情報を更新
        $user->last_login_at = now();
        $user->last_login_ip = request()->ip();
        $user->save();

        // ログイン履歴を記録
        LoginHistory::create([
            'user_id' => $user->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'login_method' => 'password',
            'is_successful' => true,
            'login_at' => now(),
        ]);
    }
}
