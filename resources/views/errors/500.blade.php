@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="error-page mb-5">
                <h1 class="display-1 text-muted">500</h1>
                <h2 class="mb-4">システムエラーが発生しました</h2>
                <p class="lead text-muted mb-5">
                    申し訳ありません。サーバーで予期せぬエラーが発生しました。<br>
                    この問題は一時的なものである可能性があります。
                </p>
                <div class="alert alert-warning mb-4">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    以下の操作をお試しください：
                    <ul class="list-unstyled mt-3 text-start">
                        <li><i class="fas fa-sync-alt me-2"></i>ページを再読み込みする</li>
                        <li><i class="fas fa-trash-alt me-2"></i>ブラウザのキャッシュをクリアする</li>
                        <li><i class="fas fa-clock me-2"></i>しばらく時間をおいて再度アクセスする</li>
                    </ul>
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ url('/') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>ホームページへ
                    </a>
                    <button onclick="window.history.back()" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>前のページへ戻る
                    </button>
                    <button onclick="location.reload()" class="btn btn-success">
                        <i class="fas fa-sync-alt me-2"></i>再読み込み
                    </button>
                </div>
            </div>
            <div class="mt-5">
                <p class="text-muted">
                    エラーが解決しない場合は、
                    <a href="mailto:support@example.com">サポートチーム</a>
                    までご連絡ください。<br>
                    その際、以下の情報をお伝えいただけると幸いです：
                </p>
                <div class="alert alert-light text-start">
                    <small>
                        <strong>エラー発生時刻：</strong> {{ now()->format('Y-m-d H:i:s') }}<br>
                        <strong>URL：</strong> {{ request()->fullUrl() }}<br>
                        <strong>リファラー：</strong> {{ request()->server('HTTP_REFERER') ?? 'なし' }}
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .error-page {
        padding: 3rem 0;
    }
    .error-page h1 {
        font-size: 8rem;
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }
    .alert-warning {
        background-color: rgba(var(--bs-warning-rgb), 0.1);
        border: none;
    }
    .alert-warning ul li {
        margin-bottom: 0.5rem;
    }
    .alert-warning ul li:last-child {
        margin-bottom: 0;
    }
    .alert-light {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
    }
</style>
@endpush
@endsection 