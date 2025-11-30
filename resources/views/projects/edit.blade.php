<!-- resources/views/projects/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
    <h1 class="mb-4">プロジェクトの編集</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('projects.update', $project->id) }}" method="POST" enctype="multipart/form-data" id="projectForm">
            @csrf
            @method('PUT')
        
        <div class="mb-3">
            <label for="project_name" class="form-label">プロジェクト名 <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="project_name" name="project_name" value="{{ old('project_name', $project->project_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="project_description" class="form-label">プロジェクトの説明 <span class="text-danger">*</span></label>
            <textarea class="form-control" id="project_description" name="project_description" rows="3" required>{{ old('project_description', $project->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="project_image" class="form-label">プロジェクト画像 <span class="text-danger">*</span></label>
            <input type="file" class="form-control" id="project_image" name="project_image" accept="image/jpeg,image/png,image/gif">
            <div id="imageHelp" class="form-text">PNG, JPG, GIF形式（最大5MB）</div>
            @if($project->project_image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $project->project_image) }}" alt="現在の画像" class="img-thumbnail" style="max-height: 200px;">
                    <p class="form-text">現在の画像</p>
                </div>
            @endif
            @error('project_image')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="target_amount" class="form-label">目標金額 (円) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="target_amount" name="target_amount" value="{{ old('target_amount', $project->target_pledge_amount) }}" min="1" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="deadline" class="form-label">締切日 <span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="deadline" name="deadline" value="{{ old('deadline', $project->deadline->format('Y-m-d')) }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="project_type" class="form-label">プロジェクトタイプ <span class="text-danger">*</span></label>
                <select class="form-select" id="project_type" name="project_type" required>
                    <option value="">選択してください</option>
                    <option value="all_or_nothing" {{ old('project_type', $project->project_type) == 'all_or_nothing' ? 'selected' : '' }}>All or Nothing</option>
                    <option value="keep_it_all" {{ old('project_type', $project->project_type) == 'keep_it_all' ? 'selected' : '' }}>Keep it All</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="project_category_id" class="form-label">カテゴリー <span class="text-danger">*</span></label>
                <select class="form-select" id="project_category_id" name="project_category_id" required>
                    <option value="">選択してください</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->project_category_id }}" {{ old('project_category_id', $project->project_category_id) == $category->project_category_id ? 'selected' : '' }}>
                            {{ $category->category_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="initiator_name" class="form-label">起案者名 <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="initiator_name" name="initiator_name" value="{{ old('initiator_name', $project->initiator_name) }}" required>
        </div>

        <div class="mb-4">
            <h3>リワード設定</h3>
            <div id="rewards">
                @foreach($project->rewards as $index => $reward)
                    <div class="reward-item mb-4 p-4 border rounded">
                        <div class="form-group mb-3">
                            <label for="reward_name_{{ $index }}" class="form-label">リワード名</label>
                            <input type="text" class="form-control" name="rewards[{{ $index }}][reward_name]" id="reward_name_{{ $index }}" value="{{ $reward->reward_name }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="price_incl_tax_{{ $index }}" class="form-label">金額（税込）</label>
                            <input type="number" class="form-control" name="rewards[{{ $index }}][price_incl_tax]" id="price_incl_tax_{{ $index }}" value="{{ $reward->price_incl_tax }}" required min="1">
                        </div>
                        <div class="form-group mb-3">
                            <label for="reward_description_{{ $index }}" class="form-label">リワードの説明</label>
                            <textarea class="form-control" name="rewards[{{ $index }}][reward_description]" id="reward_description_{{ $index }}" rows="3" required>{{ $reward->reward_description }}</textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="reward_image_{{ $index }}" class="form-label">リワード画像</label>
                            <input type="file" class="form-control" name="rewards[{{ $index }}][reward_image]" id="reward_image_{{ $index }}" accept="image/*">
                            @if($reward->reward_image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $reward->reward_image) }}" alt="現在のリワード画像" class="img-thumbnail" style="max-height: 100px;">
                                </div>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="delivery_schedule_{{ $index }}" class="form-label">お届け予定日</label>
                            <input type="date" class="form-control" name="rewards[{{ $index }}][delivery_schedule]" id="delivery_schedule_{{ $index }}" value="{{ $reward->delivery_schedule->format('Y-m-d') }}" required>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-secondary" id="addReward">リワードを追加</button>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">変更を保存</button>
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('projectForm');
    const imageInput = document.getElementById('project_image');
    let rewardCounter = {{ count($project->rewards) }};  // 既存のリワード数から開始

    // フォーム送信前の処理
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // デバッグ用の情報出力
        console.log('Form submission started');
        
        // 必須フィールドのチェック
        const requiredFields = [
            'project_name',
            'project_description',
            'target_amount',
            'deadline',
            'project_type',
            'project_category_id',
            'initiator_name'
        ];

        let hasError = false;
        requiredFields.forEach(field => {
            const element = document.getElementById(field);
            if (!element.value) {
                console.error(`Required field ${field} is empty`);
                hasError = true;
            } else {
                console.log(`Field ${field}: ${element.value}`);
            }
        });

        // リワードのチェック
        const rewardItems = document.querySelectorAll('.reward-item');
        if (rewardItems.length === 0) {
            console.error('No rewards defined');
            alert('少なくとも1つのリワードを設定してください。');
            hasError = true;
        } else {
            console.log(`Number of rewards: ${rewardItems.length}`);
            rewardItems.forEach((item, index) => {
                const nameInput = item.querySelector(`input[name="rewards[${index}][reward_name]"]`);
                const priceInput = item.querySelector(`input[name="rewards[${index}][price_incl_tax]"]`);
                const descInput = item.querySelector(`textarea[name="rewards[${index}][reward_description]"]`);
                const dateInput = item.querySelector(`input[name="rewards[${index}][delivery_schedule]"]`);

                if (!nameInput.value || !priceInput.value || !descInput.value || !dateInput.value) {
                    console.error(`Reward ${index + 1} is incomplete`);
                    alert(`リワード${index + 1}の必須項目を入力してください。`);
                    hasError = true;
                } else {
                    console.log(`Reward ${index + 1}: ${nameInput.value} - ${priceInput.value}円`);
                }
            });
        }

        // 画像ファイルのチェック
        const file = imageInput.files[0];
        if (file) {
            console.log('File information:', {
                name: file.name,
                type: file.type,
                size: file.size,
                lastModified: file.lastModified
            });

            // ファイルサイズチェック (5MB)
            if (file.size > 5 * 1024 * 1024) {
                console.error('File size exceeds 5MB');
                alert('ファイルサイズは5MB以下にしてください。');
                hasError = true;
            }

            // ファイル形式チェック
            if (!file.type.match('image/(jpeg|png|jpg|gif)')) {
                console.error('Invalid file type:', file.type);
                alert('JPG、PNG、GIF形式の画像ファイルを選択してください。');
                hasError = true;
            }
        }

        if (!hasError) {
            console.log('Form validation passed, submitting...');
            form.submit();
        }
    });

    // リワード追加ボタンの処理
    document.getElementById('addReward').addEventListener('click', function() {
        const rewardsContainer = document.getElementById('rewards');
        const newReward = document.createElement('div');
        newReward.className = 'reward-item mb-4 p-4 border rounded';
        newReward.innerHTML = `
            <div class="form-group mb-3">
                <label for="reward_name_${rewardCounter}" class="form-label">リワード名</label>
                <input type="text" class="form-control" name="rewards[${rewardCounter}][reward_name]" id="reward_name_${rewardCounter}" required>
            </div>
            <div class="form-group mb-3">
                <label for="price_incl_tax_${rewardCounter}" class="form-label">金額（税込）</label>
                <input type="number" class="form-control" name="rewards[${rewardCounter}][price_incl_tax]" id="price_incl_tax_${rewardCounter}" required min="1">
            </div>
            <div class="form-group mb-3">
                <label for="reward_description_${rewardCounter}" class="form-label">リワードの説明</label>
                <textarea class="form-control" name="rewards[${rewardCounter}][reward_description]" id="reward_description_${rewardCounter}" rows="3" required></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="reward_image_${rewardCounter}" class="form-label">リワード画像</label>
                <input type="file" class="form-control" name="rewards[${rewardCounter}][reward_image]" id="reward_image_${rewardCounter}" accept="image/*">
            </div>
            <div class="form-group mb-3">
                <label for="delivery_schedule_${rewardCounter}" class="form-label">お届け予定日</label>
                <input type="date" class="form-control" name="rewards[${rewardCounter}][delivery_schedule]" id="delivery_schedule_${rewardCounter}" required>
    </div>
        `;
        rewardsContainer.appendChild(newReward);
        rewardCounter++;
    });
});
</script>
@endpush
@endsection
