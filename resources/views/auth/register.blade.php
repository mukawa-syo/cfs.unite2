@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-75">
        <div class="col-md-6">
            <div class="text-center mb-4">
                <h1 class="h3 fw-bold text-primary">Uknight Cloud</h1>
                <p class="text-muted">新規アカウントを作成して、プロジェクトを始めましょう</p>
            </div>
            
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="form-label fw-medium">{{ __('お名前') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-user text-muted"></i>
                                </span>
                                <input id="name" type="text" 
                                    class="form-control border-start-0 @error('name') is-invalid @enderror" 
                                    name="name" value="{{ old('name') }}" 
                                    required autocomplete="name" autofocus
                                    placeholder="山田 太郎">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-medium">{{ __('メールアドレス') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-envelope text-muted"></i>
                                </span>
                                <input id="email" type="email" 
                                    class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                    name="email" value="{{ old('email') }}" 
                                    required autocomplete="email"
                                    placeholder="example@email.com">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-medium">{{ __('パスワード') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input id="password" type="password" 
                                    class="form-control border-start-0 @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="new-password"
                                    placeholder="8文字以上の英数字">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-text">
                                8文字以上で、英字と数字を含める必要があります
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label fw-medium">{{ __('パスワード（確認）') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-muted"></i>
                                </span>
                                <input id="password-confirm" type="password" 
                                    class="form-control border-start-0" 
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="パスワードを再入力">
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="terms" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    <a href="{{ route('terms') }}" class="text-decoration-none" target="_blank">利用規約</a>と
                                    <a href="{{ route('privacy') }}" class="text-decoration-none" target="_blank">プライバシーポリシー</a>に同意します
                                </label>
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus me-2"></i>{{ __('アカウントを作成') }}
                            </button>
                        </div>

                        <div class="text-center">
                            <p class="text-muted">
                                すでにアカウントをお持ちの方は 
                                <a href="{{ route('login') }}" class="text-decoration-none">ログイン</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.min-vh-75 {
    min-height: 75vh;
}
.input-group-text {
    background-color: #f8f9fa;
}
.form-control:focus {
    box-shadow: none;
    border-color: #2563eb;
}
.btn-primary {
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    transition: all 0.2s;
}
.btn-primary:hover {
    transform: translateY(-1px);
}
</style>
@endsection
