<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProjectCategory;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['category_name' => 'テクノロジー', 'icon' => 'fas fa-microchip', 'description' => '最新のテクノロジーとイノベーション'],
            ['category_name' => 'アート', 'icon' => 'fas fa-palette', 'description' => '芸術作品とクリエイティブな表現'],
            ['category_name' => '音楽', 'icon' => 'fas fa-music', 'description' => '音楽制作とパフォーマンス'],
            ['category_name' => '映画', 'icon' => 'fas fa-film', 'description' => '映画制作と映像作品'],
            ['category_name' => 'ゲーム', 'icon' => 'fas fa-gamepad', 'description' => 'ゲーム開発とエンターテイメント'],
            ['category_name' => '出版', 'icon' => 'fas fa-book', 'description' => '書籍出版とメディア制作'],
            ['category_name' => 'ファッション', 'icon' => 'fas fa-tshirt', 'description' => 'ファッションデザインとブランド'],
            ['category_name' => '食品', 'icon' => 'fas fa-utensils', 'description' => '食品開発とレストラン'],
            ['category_name' => 'スポーツ', 'icon' => 'fas fa-dumbbell', 'description' => 'スポーツ活動とフィットネス'],
            ['category_name' => '社会貢献', 'icon' => 'fas fa-hands-helping', 'description' => '社会問題解決とボランティア'],
            ['category_name' => 'その他', 'icon' => 'fas fa-ellipsis-h', 'description' => 'その他のプロジェクト'],
        ];

        foreach ($categories as $category) {
            ProjectCategory::create($category);
        }
    }
}
