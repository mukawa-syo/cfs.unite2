@extends('layouts.app')

@section('content')
<style>
    .request-section {
        padding: 3rem 0;
        background: #f8f9fa;
        min-height: calc(100vh - 200px);
    }

    .request-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .request-card {
        background: white;
        border-radius: 16px;
        padding: 3rem;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    }

    .request-header {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .request-header h1 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .request-header p {
        color: var(--text-secondary);
        font-size: 1.125rem;
    }

    .alert-box {
        background: #fff3cd;
        border: 1px solid #ffc107;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .alert-box-icon {
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .alert-box h3 {
        font-size: 1.25rem;
        font-weight: 600;
        color: #856404;
        margin-bottom: 0.5rem;
    }

    .alert-box p {
        color: #856404;
        margin: 0;
    }

    .form-label {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
    }

    .form-control {
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 0.875rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(34, 139, 34, 0.15);
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        border: none;
        padding: 1rem 2.5rem;
        font-size: 1.125rem;
        font-weight: 600;
        border-radius: 8px;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(34, 139, 34, 0.3);
        color: white;
    }

    .info-text {
        background: #e7f3ff;
        border-left: 4px solid #2196F3;
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-text h4 {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1976D2;
        margin-bottom: 0.75rem;
    }

    .info-text ul {
        margin: 0;
        padding-left: 1.5rem;
        color: var(--text-primary);
    }

    .info-text li {
        margin-bottom: 0.5rem;
        line-height: 1.6;
    }

    .text-muted {
        font-size: 0.875rem;
        color: #6c757d;
    }
</style>

<section class="request-section">
    <div class="request-container">
        <div class="request-card">
            <div class="request-header">
                <h1><i class="fas fa-file-signature me-2"></i>プロジェクト作成申請</h1>
                <p>プロジェクトを作成するには、まず承認が必要です</p>
            </div>

            @if($alreadyHasPermission)
                <div class="alert-box">
                    <div class="text-center">
                        <i class="fas fa-check-circle alert-box-icon text-success"></i>
                        <h3>既に承認済みです</h3>
                        <p>あなたは既にプロジェクト作成の承認を受けています。<a href="{{ route('projects.create') }}" class="text-decoration-none fw-bold">プロジェクトを作成する</a></p>
                    </div>
                </div>
            @elseif($hasPendingRequest)
                <div class="alert-box">
                    <div class="text-center">
                        <i class="fas fa-clock alert-box-icon text-warning"></i>
                        <h3>審査中の申請があります</h3>
                        <p>申請が審査中です。結果をお待ちください。<br>承認されると、プロジェクトを作成できるようになります。</p>
                    </div>
                </div>
            @else
                <div class="info-text">
                    <h4><i class="fas fa-info-circle me-2"></i>ご利用にあたって</h4>
                    <ul>
                        <li>プロジェクトを作成するには、事前に審査を受ける必要があります</li>
                        <li>申請理由は50文字以上、1000文字以内で入力してください</li>
                        <li>審査には数日かかる場合があります</li>
                        <li>承認後はプロジェクト作成が可能になります</li>
                    </ul>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('project-creation-requests.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="reason" class="form-label">
                            申請理由 <span class="text-danger">*</span>
                        </label>
                        <textarea 
                            id="reason" 
                            name="reason" 
                            class="form-control @error('reason') is-invalid @enderror" 
                            rows="8" 
                            required 
                            placeholder="プロジェクトを作成したい理由を詳しく教えてください。&#10;例：地域の魅力を広めるためのクラフトビールを制作したい&#10;   地域の障がい者支援のためのイベントを開催したい&#10;   伝統工芸の継承を目的としたプロダクトを開発したい"
                        >{{ old('reason') }}</textarea>
                        @error('reason')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="text-muted mt-2">
                            <small>50文字以上、1000文字以内で入力してください</small>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-submit">
                            <i class="fas fa-paper-plane me-2"></i>申請を送信
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        <p class="text-muted mb-0">
                            <small><i class="fas fa-envelope me-1"></i>申請後、審査結果は登録メールアドレス（{{ Auth::user()->email }}）に通知されます</small>
                        </p>
                    </div>
                </form>
            @endif
        </div>
    </div>
</section>
@endsection

