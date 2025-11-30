<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Unsplashのフリー画像URLを設定
        $projectImages = [
            'AI搭載スマートウォッチ開発' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=800&h=600&fit=crop&crop=center',
            '地域密着型カフェ開店' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=800&h=600&fit=crop&crop=center',
            '子ども向けプログラミング教室' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=800&h=600&fit=crop&crop=center',
            '地域スポーツチーム支援' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&h=600&fit=crop&crop=center',
            'アーティスト個展開催' => 'https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=800&h=600&fit=crop&crop=center',
            '環境保護プロジェクト' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800&h=600&fit=crop&crop=center',
        ];

        foreach ($projectImages as $title => $imageUrl) {
            $project = Project::where('title', $title)->first();
            if ($project) {
                $project->update(['project_image' => $imageUrl]);
                $this->command->info("プロジェクト '{$title}' に画像を設定しました。");
            }
        }

        $this->command->info('プロジェクト画像の設定が完了しました。');
    }
}