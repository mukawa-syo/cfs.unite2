<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use TCG\Voyager\Traits\VoyagerUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, VoyagerUser;

    /**
     * このアプリで使う主なカラム。必要に応じて増やしてOK
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'can_create_projects',
        'postal_code', 'prefecture', 'city', 'address', 'building_name', 'phone_number',
    ];

    protected $hidden = [
        'password', 'remember_token',
        'two_factor_secret', 'two_factor_recovery_codes',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'can_create_projects' => 'boolean',
        // Laravel10 では 'password' => 'hashed' キャストが使えますが
        // 既存のbcrypt運用を邪魔しないように外しています。必要なら有効化してください。
        // 'password' => 'hashed',
    ];

    /**
     * VoyagerのRoleリレーション。role_id で紐づきます
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(\TCG\Voyager\Models\Role::class, 'role_id');
    }

    /**
     * 権限判定（堅牢版）
     * - role_id==1（admin）は常に許可
     * - それ以外は DB を直接参照して permission_role（＋あれば permission_user）から判定
     *   ※ テーブルが無い環境でも例外を出さず false を返す
     */
    public function hasPermission($name, $arguments = null)
    {
        if ((int)($this->role_id ?? 0) === 1) {
            return true;
        }

        try {
            // 直接ユーザー権限（permission_user）があればそちらを先に確認（無ければスキップ）
            if (Schema::hasTable('permission_user')) {
                $direct = DB::table('permission_user')
                    ->join('permissions', 'permissions.id', '=', 'permission_user.permission_id')
                    ->where('permission_user.user_id', $this->id)
                    ->where('permissions.key', $name)
                    ->exists();
                if ($direct) {
                    return true;
                }
            }

            // ロール権限
            if (Schema::hasTable('permission_role')) {
                return DB::table('permission_role')
                    ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
                    ->where('permission_role.role_id', (int)($this->role_id ?? 0))
                    ->where('permissions.key', $name)
                    ->exists();
            }
        } catch (\Throwable $e) {
            // 何かあっても落とさない
        }
        return false;
    }

    /** VoyagerのRoleリレーション（属性名 "role" との衝突回避用） */
    public function voyagerRole(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\TCG\Voyager\Models\Role::class, 'role_id');
    }

    /**
     * Get the user's project creation requests
     */
    public function projectCreationRequests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProjectCreationRequest::class);
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole($roleName)
    {
        if ($this->role_id == 1) {
            return in_array($roleName, ['admin', 'administrator']);
        }

        try {
            if (Schema::hasTable('roles')) {
                $role = DB::table('roles')->where('name', $roleName)->first();
                return $role && $this->role_id == $role->id;
            }
        } catch (\Throwable $e) {
            // Silent fail
        }

        return false;
    }
}
