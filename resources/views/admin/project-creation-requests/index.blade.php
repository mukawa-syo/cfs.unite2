@extends('layouts.app')

@section('content')
<style>
    .admin-section {
        padding: 2rem 0;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
    }

    .request-card {
        background: white;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .request-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .status-badge {
        display: inline-block;
        padding: 0.375rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-approved {
        background: #d4edda;
        color: #155724;
    }

    .status-rejected {
        background: #f8d7da;
        color: #721c24;
    }

    .btn-approve {
        background: var(--primary-color);
        color: white;
    }

    .btn-reject {
        background: #dc3545;
        color: white;
    }
</style>

<section class="admin-section">
    <div class="container">
        <div class="page-header">
            <h1><i class="fas fa-clipboard-list me-2"></i>プロジェクト作成申請一覧</h1>
            <p class="mb-0">ユーザーからの申請を承認・拒否します</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-md-12">
                @forelse($requests as $request)
                    <div class="request-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <h5 class="mb-2">
                                    <i class="fas fa-user me-2"></i>{{ $request->user->name }}
                                    <span class="status-badge status-{{ $request->status }}">
                                        @if($request->status === 'pending')
                                            審査中
                                        @elseif($request->status === 'approved')
                                            承認済み
                                        @else
                                            拒否
                                        @endif
                                    </span>
                                </h5>
                                <p class="text-muted mb-2">
                                    <i class="fas fa-envelope me-1"></i>{{ $request->user->email }}
                                </p>
                                <p class="mb-2">
                                    <strong>申請理由：</strong><br>
                                    {{ $request->reason }}
                                </p>
                                @if($request->status !== 'pending')
                                    <div class="mt-2">
                                        <p class="text-muted mb-1">
                                            <strong>審査日時：</strong>{{ $request->reviewed_at->format('Y年m月d日 H:i') }}
                                        </p>
                                        @if($request->comment)
                                            <p class="text-muted mb-0">
                                                <strong>コメント：</strong>{{ $request->comment }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        @if($request->status === 'pending')
                            <div class="mt-3">
                                <form action="{{ route('manage.project-creation-requests.approve', $request) }}" method="POST" class="d-inline me-2">
                                    @csrf
                                    <button type="submit" class="btn btn-approve">
                                        <i class="fas fa-check me-2"></i>承認
                                    </button>
                                </form>
                                
                                <button type="button" class="btn btn-reject" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $request->id }}">
                                    <i class="fas fa-times me-2"></i>拒否
                                </button>

                                <!-- Reject Modal -->
                                <div class="modal fade" id="rejectModal{{ $request->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">拒否理由を入力</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('manage.project-creation-requests.reject', $request) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <textarea name="comment" class="form-control" rows="4" placeholder="拒否理由を入力してください" required></textarea>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">キャンセル</button>
                                                    <button type="submit" class="btn btn-reject">拒否する</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">申請がありません</p>
                    </div>
                @endforelse

                {{ $requests->links() }}
            </div>
        </div>
    </div>
</section>
@endsection


