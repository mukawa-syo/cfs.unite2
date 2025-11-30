<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'ip_address',
        'user_agent',
        'login_method',
        'is_successful',
        'failure_reason',
        'login_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_successful' => 'boolean',
        'login_at' => 'datetime',
    ];

    /**
     * ユーザーとのリレーション
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ログイン履歴を記録
     *
     * @param User $user
     * @param bool $isSuccessful
     * @param string|null $failureReason
     * @return LoginHistory
     */
    public static function recordLogin(User $user, bool $isSuccessful = true, ?string $failureReason = null): LoginHistory
    {
        return self::create([
            'user_id' => $user->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'login_method' => 'password',
            'is_successful' => $isSuccessful,
            'failure_reason' => $failureReason,
            'login_at' => now(),
        ]);
    }

    /**
     * 最近のログイン履歴を取得
     *
     * @param User $user
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getRecentLogins(User $user, int $limit = 5)
    {
        return self::where('user_id', $user->id)
            ->orderBy('login_at', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * 失敗したログイン試行を取得
     *
     * @param string $ipAddress
     * @param int $minutes
     * @return int
     */
    public static function getFailedAttempts(string $ipAddress, int $minutes = 30): int
    {
        return self::where('ip_address', $ipAddress)
            ->where('is_successful', false)
            ->where('login_at', '>=', now()->subMinutes($minutes))
            ->count();
    }
}
