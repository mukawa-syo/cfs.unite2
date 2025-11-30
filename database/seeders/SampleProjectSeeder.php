<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\User;
use App\Models\Reward;

class SampleProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ユーザーとカテゴリーを取得
        $user = User::first();
        $categories = ProjectCategory::all();

        if (!$user || $categories->isEmpty()) {
            $this->command->error('ユーザーまたはカテゴリーが見つかりません。');
            return;
        }

        $sampleProjects = [
            [
                'title' => 'AI搭載スマートウォッチ開発',
                'description' => '最新のAI技術を搭載したスマートウォッチを開発します。健康管理、運動記録、通知機能など、日常生活をサポートする多機能デバイスです。',
                'goal_amount' => 2000000,
                'deadline' => now()->addDays(45),
                'project_category_id' => $categories->where('category_name', 'テクノロジー')->first()->project_category_id,
                'is_featured' => true,
                'rewards' => [
                    [
                        'reward_name' => '早期支援者特典',
                        'price_incl_tax' => 5000,
                        'reward_description' => 'プロジェクト完成後のスマートウォッチを特別価格でご提供',
                        'delivery_schedule' => now()->addDays(60),
                    ],
                    [
                        'reward_name' => '限定カラー版',
                        'price_incl_tax' => 15000,
                        'reward_description' => '限定カラーのスマートウォッチ + 専用ケース',
                        'delivery_schedule' => now()->addDays(60),
                    ],
                ]
            ],
            [
                'title' => '地域密着型カフェ開店',
                'description' => '地元の食材を使用した手作りスイーツとコーヒーを提供するカフェを開店します。地域コミュニティの拠点となる温かい空間を作ります。',
                'goal_amount' => 1500000,
                'deadline' => now()->addDays(30),
                'project_category_id' => $categories->where('category_name', '食品')->first()->project_category_id,
                'is_featured' => false,
                'rewards' => [
                    [
                        'reward_name' => 'オープン記念セット',
                        'price_incl_tax' => 3000,
                        'reward_description' => 'オープン記念のオリジナルクッキーとコーヒーセット',
                        'delivery_schedule' => now()->addDays(35),
                    ],
                    [
                        'reward_name' => '年間パスポート',
                        'price_incl_tax' => 10000,
                        'reward_description' => '1年間無料でコーヒーとスイーツをお楽しみいただけるパスポート',
                        'delivery_schedule' => now()->addDays(35),
                    ],
                ]
            ],
            [
                'title' => '子ども向けプログラミング教室',
                'description' => '小学生から中学生を対象としたプログラミング教室を開講します。ゲーム作りを通じて楽しくプログラミングを学べる環境を提供します。',
                'goal_amount' => 800000,
                'deadline' => now()->addDays(25),
                'project_category_id' => $categories->where('category_name', 'テクノロジー')->first()->project_category_id,
                'is_featured' => false,
                'rewards' => [
                    [
                        'reward_name' => '体験レッスン参加券',
                        'price_incl_tax' => 2000,
                        'reward_description' => '90分のプログラミング体験レッスンにご参加いただけます',
                        'delivery_schedule' => now()->addDays(30),
                    ],
                    [
                        'reward_name' => '3ヶ月コース受講券',
                        'price_incl_tax' => 15000,
                        'reward_description' => '3ヶ月間のプログラミングコースを特別価格で受講可能',
                        'delivery_schedule' => now()->addDays(30),
                    ],
                ]
            ],
            [
                'title' => '地域スポーツチーム支援',
                'description' => '地元の少年野球チームの活動を支援します。新しいユニフォームや練習用具の購入、遠征費の支援を行います。',
                'goal_amount' => 500000,
                'deadline' => now()->addDays(20),
                'project_category_id' => $categories->where('category_name', 'スポーツ')->first()->project_category_id,
                'is_featured' => false,
                'rewards' => [
                    [
                        'reward_name' => '応援グッズセット',
                        'price_incl_tax' => 1000,
                        'reward_description' => 'チームロゴ入りの応援グッズセット（タオル、マスコット）',
                        'delivery_schedule' => now()->addDays(25),
                    ],
                    [
                        'reward_name' => '試合観戦チケット',
                        'price_incl_tax' => 5000,
                        'reward_description' => '公式戦の試合観戦チケット + 選手との記念撮影',
                        'delivery_schedule' => now()->addDays(25),
                    ],
                ]
            ],
            [
                'title' => 'アーティスト個展開催',
                'description' => '新進気鋭のアーティストによる個展を開催します。現代アートの新しい表現を多くの方に知っていただく機会を作ります。',
                'goal_amount' => 1200000,
                'deadline' => now()->addDays(40),
                'project_category_id' => $categories->where('category_name', 'アート')->first()->project_category_id,
                'is_featured' => true,
                'rewards' => [
                    [
                        'reward_name' => '個展カタログ',
                        'price_incl_tax' => 2000,
                        'reward_description' => '個展作品を収録した限定カタログ',
                        'delivery_schedule' => now()->addDays(45),
                    ],
                    [
                        'reward_name' => 'オリジナル作品',
                        'price_incl_tax' => 50000,
                        'reward_description' => 'アーティストによるオリジナル作品（A4サイズ）',
                        'delivery_schedule' => now()->addDays(45),
                    ],
                ]
            ],
            [
                'title' => '環境保護プロジェクト',
                'description' => '地域の自然環境を守るための活動を行います。植樹活動、清掃活動、環境教育プログラムの実施を予定しています。',
                'goal_amount' => 600000,
                'deadline' => now()->addDays(35),
                'project_category_id' => $categories->where('category_name', '社会貢献')->first()->project_category_id,
                'is_featured' => false,
                'rewards' => [
                    [
                        'reward_name' => '活動参加券',
                        'price_incl_tax' => 1000,
                        'reward_description' => '植樹活動や清掃活動にご参加いただける参加券',
                        'delivery_schedule' => now()->addDays(40),
                    ],
                    [
                        'reward_name' => '環境報告書',
                        'price_incl_tax' => 3000,
                        'reward_description' => 'プロジェクトの成果をまとめた環境報告書',
                        'delivery_schedule' => now()->addDays(40),
                    ],
                ]
            ],
        ];

        foreach ($sampleProjects as $projectData) {
            $rewards = $projectData['rewards'];
            unset($projectData['rewards']);

            $project = Project::create([
                'title' => $projectData['title'],
                'description' => $projectData['description'],
                'goal_amount' => $projectData['goal_amount'],
                'deadline' => $projectData['deadline'],
                'project_category_id' => $projectData['project_category_id'],
                'user_id' => $user->id,
                'status' => 'open',
                'is_featured' => $projectData['is_featured'],
            ]);

            // リワードを作成
            foreach ($rewards as $rewardData) {
                Reward::create([
                    'project_id' => $project->id,
                    'reward_name' => $rewardData['reward_name'],
                    'price_incl_tax' => $rewardData['price_incl_tax'],
                    'reward_description' => $rewardData['reward_description'],
                    'delivery_schedule' => $rewardData['delivery_schedule'],
                ]);
            }

            $this->command->info("プロジェクト '{$project->title}' を作成しました。");
        }

        $this->command->info('サンプルプロジェクトの作成が完了しました。');
    }
}