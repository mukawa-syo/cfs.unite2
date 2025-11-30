<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::create([
            'name' => '管理者',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'permissions' => json_encode([
                'manage_users',
                'manage_projects',
                'manage_rewards',
                'manage_categories',
                'view_reports',
                'manage_settings'
            ]),
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'モデレーター',
            'email' => 'moderator@example.com',
            'password' => Hash::make('password'),
            'role' => 'moderator',
            'permissions' => json_encode([
                'manage_projects',
                'manage_rewards',
                'view_reports'
            ]),
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        $this->command->info('管理者ユーザーとモデレーターユーザーが作成されました。');
        $this->command->info('管理者アカウント: admin@example.com / password');
        $this->command->info('モデレーターアカウント: moderator@example.com / password');
    }
}
