<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $dummyProjects = [
            [
                'project_name' => 'テストプロジェクトA',
                'description' => 'これはテスト用のプロジェクトAです。',
                'target_pledge_amount' => 100000,
                'project_category_id' => 1,
                'user_id' => 1,
                'is_featured' => true,
                'project_type' => 'All or Nothing',
                'deadline' => now()->addDays(30),
                'initiator_name' => 'テストユーザー',
            ],
            [
                'project_name' => 'テストプロジェクトB',
                'description' => 'これはテスト用のプロジェクトBです。',
                'target_pledge_amount' => 200000,
                'project_category_id' => 1,
                'user_id' => 1,
                'is_featured' => false,
                'project_type' => 'All In',
                'deadline' => now()->addDays(45),
                'initiator_name' => 'テストユーザー',
            ],
            [
                'project_name' => 'テストプロジェクトC',
                'description' => 'これはテスト用のプロジェクトCです。',
                'target_pledge_amount' => 300000,
                'project_category_id' => 1,
                'user_id' => 1,
                'is_featured' => false,
                'project_type' => 'All or Nothing',
                'deadline' => now()->addDays(60),
                'initiator_name' => 'テストユーザー',
            ],
        ];

        foreach ($dummyProjects as $data) {
            Project::create($data);
        }
    }
} 