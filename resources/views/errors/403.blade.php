@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="error-page mb-5">
                <h1 class="display-1 text-muted">403</h1>
                <h2 class="mb-4">アクセスが拒否されました</h2>
                <p class="lead text-muted mb-5">
                    申し訳ありません。このページにアクセスする権限がありません。
                </p>
                <div class="alert alert-info mb-4">
                    <i class="fas fa-info-circle me-2"></i>
                    以下の理由が考えられます：
                    <ul class="list-unstyled mt-3 text-start">
                        <li><i class="fas fa-check-circle me-2"></i>ログインが必要なページです</li>
                        <li><i class="fas fa-check-circle me-2"></i>アカウントの権限が不足しています</li>
                        <li><i class="fas fa-check-circle me-2"></i>URLが間違っている可能性があります</li>
                    </ul>
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ url('/') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>ホームページへ
                    </a>
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-success">
                            <i class="fas fa-sign-in-alt me-2"></i>ログイン
                        </a>
                    @endguest
                    <button onclick="window.history.back()" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>前のページへ戻る
                    </button>
                </div>
            </div>
            @auth
                <div class="mt-4">
                    <p class="text-muted">
                        このエラーが表示され続ける場合は、
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            一度ログアウト
                        </a>
                        して再度お試しください。
                    </p>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @endauth
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
    .alert-info {
        background-color: rgba(var(--bs-info-rgb), 0.1);
        border: none;
    }
    .alert-info ul li {
        margin-bottom: 0.5rem;
    }
    .alert-info ul li:last-child {
        margin-bottom: 0;
    }
</style>
@endpush
@endsection 