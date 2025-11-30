@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8">
            <!-- ヘッダー部分 -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="mb-1">プロジェクトアップデート</h1>
                    <p class="text-muted mb-0">{{ $project->project_name }}</p>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newUpdateModal">
                    新規アップデートを投稿
                </button>
            </div>

            <!-- アップデート一覧 -->
            @if($updates->isEmpty())
                <div class="alert alert-info">
                    まだアップデートはありません。最初のアップデートを投稿してプロジェクトの進捗を共有しましょう！
                </div>
            @else
                <div class="updates-list">
                    @foreach($updates as $update)
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title mb-0">{{ $update->title }}</h5>
                                    <span class="text-muted">{{ $update->created_at->format('Y年m月d日 H:i') }}</span>
                                </div>
                                <div class="card-text mb-3">
                                    {!! nl2br(e($update->content)) !!}
                                </div>
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                            onclick="editUpdate({{ $update->id }}, '{{ addslashes($update->title) }}', '{{ addslashes($update->content) }}')"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editUpdateModal">
                                        編集
                                    </button>
                                    <form action="{{ route('dashboard.projects.updates.destroy', ['project' => $project, 'update' => $update]) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('このアップデートを削除してもよろしいですか？');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">削除</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- ページネーション -->
                    <div class="d-flex justify-content-center">
                        {{ $updates->links() }}
                    </div>
                </div>
            @endif
        </div>

        <!-- サイドバー -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">アップデートのヒント</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">✨ 定期的な進捗報告を心がけましょう</li>
                        <li class="mb-2">📸 可能であれば画像や動画も添付すると良いでしょう</li>
                        <li class="mb-2">🎯 達成したマイルストーンを共有しましょう</li>
                        <li class="mb-2">💬 支援者からの質問にも答えましょう</li>
                        <li>🙏 感謝の気持ちを忘れずに</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 新規アップデート投稿モーダル -->
<div class="modal fade" id="newUpdateModal" tabindex="-1" aria-labelledby="newUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('dashboard.projects.updates.store', $project) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="newUpdateModalLabel">新規アップデートを投稿</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">タイトル <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" 
                               id="title" name="title" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">内容 <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="10" required></textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-primary">投稿する</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- アップデート編集モーダル -->
<div class="modal fade" id="editUpdateModal" tabindex="-1" aria-labelledby="editUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="updateForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">アップデートを編集</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="updateTitle" class="form-label">タイトル <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="updateTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="updateContent" class="form-label">内容 <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="updateContent" name="content" rows="10" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                    <button type="submit" class="btn btn-primary" id="updateSubmitBtn">更新</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function editUpdate(updateId, title, content) {
    const form = document.getElementById('updateForm');
    const url = "{{ route('dashboard.projects.updates.update', ['project' => $project, 'update' => ':updateId']) }}";
    form.action = url.replace(':updateId', updateId);
    document.getElementById('updateTitle').value = title;
    document.getElementById('updateContent').value = content;
    document.getElementById('updateModalLabel').textContent = 'アップデートを編集';
    document.getElementById('updateSubmitBtn').textContent = '更新';
}
</script>
@endpush
@endsection 