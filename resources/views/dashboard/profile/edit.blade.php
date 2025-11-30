@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <!-- プロフィール情報表示 -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user me-2"></i>現在のプロフィール</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="avatar-circle bg-primary text-white mx-auto mb-3">
                            <i class="fas fa-user fa-2x"></i>
                        </div>
                        <h6 class="mb-1">{{ $user->name ?? '未設定' }}</h6>
                        <small class="text-muted">{{ $user->email ?? '未設定' }}</small>
                    </div>
                    
                    <hr>
                    
                    <div class="profile-info">
                        <div class="info-item mb-2">
                            <i class="fas fa-phone text-muted me-2"></i>
                            <span>{{ $user->phone_number ?? '未設定' }}</span>
                        </div>
                        
                        @if($user->postal_code || $user->prefecture || $user->city || $user->address)
                        <div class="info-item mb-2">
                            <i class="fas fa-map-marker-alt text-muted me-2"></i>
                            <div>
                                @if($user->postal_code)
                                    <div>〒{{ $user->postal_code }}</div>
                                @endif
                                @if($user->prefecture || $user->city || $user->address)
                                    <div>{{ $user->prefecture }}{{ $user->city }}{{ $user->address }}</div>
                                @endif
                                @if($user->building_name)
                                    <div>{{ $user->building_name }}</div>
                                @endif
                            </div>
                        </div>
                        @else
                        <div class="info-item mb-2">
                            <i class="fas fa-map-marker-alt text-muted me-2"></i>
                            <span class="text-muted">住所未設定</span>
                        </div>
                        @endif
                        
                        <div class="info-item">
                            <i class="fas fa-calendar text-muted me-2"></i>
                            <span>登録日: {{ $user->created_at ? $user->created_at->format('Y年m月d日') : '不明' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- プロフィール編集フォーム -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h4 class="mb-0"><i class="fas fa-edit me-2"></i>プロフィール編集</h4>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('dashboard.profile.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- 基本情報 -->
                        <div class="section-header mb-4">
                            <h5 class="text-primary"><i class="fas fa-user me-2"></i>基本情報</h5>
                            <hr class="my-2">
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-bold">名前 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $user->name) }}" 
                                       placeholder="山田太郎" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label fw-bold">メールアドレス <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $user->email) }}" 
                                       placeholder="example@email.com" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label fw-bold">電話番号</label>
                            <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" 
                                   id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" 
                                   placeholder="090-1234-5678">
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- 住所情報 -->
                        <div class="section-header mb-4 mt-5">
                            <h5 class="text-primary"><i class="fas fa-map-marker-alt me-2"></i>住所情報</h5>
                            <hr class="my-2">
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="postal_code" class="form-label fw-bold">郵便番号</label>
                                <input type="text" class="form-control @error('postal_code') is-invalid @enderror" 
                                       id="postal_code" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" 
                                       placeholder="123-4567">
                                @error('postal_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="prefecture" class="form-label fw-bold">都道府県</label>
                                <input type="text" class="form-control @error('prefecture') is-invalid @enderror" 
                                       id="prefecture" name="prefecture" value="{{ old('prefecture', $user->prefecture) }}" 
                                       placeholder="東京都">
                                @error('prefecture')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="city" class="form-label fw-bold">市区町村</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                       id="city" name="city" value="{{ old('city', $user->city) }}" 
                                       placeholder="新宿区">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="address" class="form-label fw-bold">番地</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" 
                                       id="address" name="address" value="{{ old('address', $user->address) }}" 
                                       placeholder="1-2-3">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="building_name" class="form-label fw-bold">建物名・部屋番号</label>
                                <input type="text" class="form-control @error('building_name') is-invalid @enderror" 
                                       id="building_name" name="building_name" value="{{ old('building_name', $user->building_name) }}" 
                                       placeholder="マンション101">
                                @error('building_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- パスワード変更 -->
                        <div class="section-header mb-4 mt-5">
                            <h5 class="text-primary"><i class="fas fa-lock me-2"></i>パスワード変更</h5>
                            <hr class="my-2">
                            <small class="text-muted">パスワードを変更する場合のみ入力してください</small>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="current_password" class="form-label fw-bold">現在のパスワード</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                       id="current_password" name="current_password" 
                                       placeholder="現在のパスワード">
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="new_password" class="form-label fw-bold">新しいパスワード</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                                       id="new_password" name="new_password" 
                                       placeholder="新しいパスワード">
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="new_password_confirmation" class="form-label fw-bold">確認用パスワード</label>
                                <input type="password" class="form-control" 
                                       id="new_password_confirmation" name="new_password_confirmation" 
                                       placeholder="確認用パスワード">
                            </div>
                        </div>

                        <!-- ボタン -->
                        <div class="d-flex justify-content-between mt-5">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i>ダッシュボードに戻る
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>プロフィールを更新
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
}

.section-header {
    position: relative;
}

.section-header h5 {
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.info-item {
    display: flex;
    align-items: flex-start;
    padding: 0.5rem 0;
}

.info-item i {
    width: 20px;
    margin-top: 0.2rem;
}

.profile-info {
    font-size: 0.9rem;
}

.card {
    border: none;
    border-radius: 12px;
}

.card-header {
    border-radius: 12px 12px 0 0 !important;
    border-bottom: 1px solid #e9ecef;
}

.form-control {
    border-radius: 8px;
    border: 1px solid #dee2e6;
    padding: 0.75rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.btn {
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%);
    transform: translateY(-1px);
}

.alert {
    border-radius: 8px;
    border: none;
}

@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }
    
    .col-md-4 {
        margin-bottom: 2rem;
    }
}
</style>
@endsection