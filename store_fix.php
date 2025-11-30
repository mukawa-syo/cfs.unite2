<?php
$path = __DIR__ . '/app/Http/Controllers/ProjectController.php';
$src  = file_get_contents($path);
if ($src === false) { fwrite(STDERR,"read fail\n"); exit(1); }

$pattern = '#public\s+function\s+store\s*\(.*?\)\s*\{.*?\}\s*(?=public\s+function\s+edit\s*\()#s';

$replacement = <<<'CODE'
public function store(Request $request)
{
    // 入力バリデーション（フォーム名は現状のまま）
    $request->validate([
        'project_name'                     => 'required|string|max:255|regex:/^[ぁ-んァ-ヶー々一-龠a-zA-Z0-9\s\-_]+$/u',
        'project_description'              => 'required|string|min:10|max:10000',
        'project_image'                    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        'target_amount'                    => 'required|numeric|min:1000|max:100000000',
        'deadline'                         => 'required|date|after:today|before:+1 year',
        'project_type'                     => 'nullable|string|in:all_or_nothing,keep_it_all',
        'project_category_id'              => 'required|exists:project_categories,project_category_id',
        'initiator_name'                   => 'nullable|string|max:255|regex:/^[ぁ-んァ-ヶー々一-龠a-zA-Z0-9\s\-_]+$/u',
        'rewards'                          => 'required|array|min:1|max:10',
        'rewards.*.reward_name'            => 'required|string|max:255|regex:/^[ぁ-んァ-ヶー々一-龠a-zA-Z0-9\s\-_]+$/u',
        'rewards.*.price_incl_tax'         => 'required|numeric|min:1000|max:1000000',
        'rewards.*.reward_description'     => 'required|string|min:10|max:1000',
        'rewards.*.reward_image'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        'rewards.*.delivery_schedule'      => 'required|date|after:deadline|before:+2 years',
    ], [
        'project_name.regex'                   => 'プロジェクト名に使用できない文字が含まれています。',
        'project_description.min'              => 'プロジェクトの説明は10文字以上で入力してください。',
        'project_description.max'              => 'プロジェクトの説明は10000文字以下で入力してください。',
        'target_amount.min'                    => '目標金額は1,000円以上で入力してください。',
        'target_amount.max'                    => '目標金額は100,000,000円以下で入力してください。',
        'deadline.after'                       => '締切日は今日以降の日付を選択してください。',
        'deadline.before'                      => '締切日は1年以内の日付を選択してください。',
        'initiator_name.regex'                 => '発起人名に使用できない文字が含まれています。',
        'rewards.max'                          => 'リワードは10個までしか登録できません。',
        'rewards.*.reward_name.regex'          => 'リワード名に使用できない文字が含まれています。',
        'rewards.*.price_incl_tax.min'         => 'リワードの金額は1,000円以上で入力してください。',
        'rewards.*.price_incl_tax.max'         => 'リワードの金額は1,000,000円以下で入力してください。',
        'rewards.*.reward_description.min'     => 'リワードの説明は10文字以上で入力してください。',
        'rewards.*.reward_description.max'     => 'リワードの説明は1000文字以下で入力してください。',
        'rewards.*.delivery_schedule.after'    => 'お届け予定日はプロジェクトの締切日以降の日付を選択してください。',
        'rewards.*.delivery_schedule.before'   => 'お届け予定日は2年以内の日付を選択してください。',
    ]);

    \Log::info('Project creation started', ['request' => $request->except(['project_image','rewards.*.reward_image'])]);

    try {
        DB::beginTransaction();

        // 画像は保存だけ（projects テーブルにはカラムが無い）
        if ($request->hasFile('project_image')) {
            $file = $request->file('project_image');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('project-images', $filename, 'public');
            \Log::info('Project image saved', ['path' => $path]);
        }

        // ★ DB実カラムに合わせてINSERT（Modelの$fillableも修正済み）
        $project = Project::create([
            'title'               => $request->project_name,
            'description'         => $request->project_description,
            'goal_amount'         => $request->target_amount,
            'deadline'            => $request->deadline,
            'project_category_id' => $request->project_category_id,
            'user_id'             => auth()->id(),
            'status'              => 'open',
            // 'is_featured' は必要に応じて
        ]);

        // リワード作成
        foreach ($request->rewards as $rewardData) {
            $rewardImagePath = null;
            if (isset($rewardData['reward_image']) && $rewardData['reward_image'] instanceof \Illuminate\Http\UploadedFile) {
                $f = $rewardData['reward_image'];
                $rf = time().'_'.uniqid().'.'.$f->getClientOriginalExtension();
                $rewardImagePath = $f->storeAs('reward-images', $rf, 'public');
                \Log::info('Reward image saved', ['path' => $rewardImagePath]);
            }

            $reward = new Reward([
                'reward_name'        => $rewardData['reward_name'],
                'price_incl_tax'     => $rewardData['price_incl_tax'],
                'reward_description' => $rewardData['reward_description'],
                'reward_image'       => $rewardImagePath,
                'delivery_schedule'  => $rewardData['delivery_schedule'],
            ]);

            $project->rewards()->save($reward);
        }

        DB::commit();
        \Log::info('Project creation completed successfully');

        return redirect()->route('projects.index')
            ->with('success', 'プロジェクトが正常に作成されました。');

    } catch (\Exception $e) {
        DB::rollBack();
        \Log::error('Project creation failed', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return back()->withInput()
            ->with('error', 'プロジェクトの作成に失敗しました。もう一度お試しください。');
    }
}
CODE;

$cnt = 0;
$dst = preg_replace($pattern, $replacement, $src, 1, $cnt);
if ($cnt !== 1) {
    fwrite(STDERR, "store() not replaced（パターン不一致）\n");
    exit(2);
}
if (!file_put_contents($path, $dst)) {
    fwrite(STDERR, "write fail\n"); exit(3);
}
echo "store() replaced\n";
