@extends('layouts.app')

@section('content')
<style>
    .contact-section {
        padding: 5rem 0;
        background: var(--bg-secondary);
    }

    .contact-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .contact-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .contact-subtitle {
        font-size: 1.25rem;
        color: var(--text-secondary);
        max-width: 600px;
        margin: 0 auto;
    }

    .contact-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        margin-bottom: 3rem;
    }

    .contact-info {
        background: var(--bg-primary);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .contact-info h3 {
        color: var(--primary-color);
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .contact-item {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: var(--bg-secondary);
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .contact-item:hover {
        background: var(--bg-tertiary);
        transform: translateY(-2px);
    }

    .contact-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .contact-details h4 {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .contact-details p {
        color: var(--text-secondary);
        margin: 0;
    }

    .contact-form {
        background: var(--bg-primary);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: var(--shadow-sm);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: var(--bg-primary);
        color: var(--text-primary);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(42, 107, 81, 0.1);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 1rem 2rem;
        border: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
    }

    .btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .success-message {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
    }

    .error-message {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
    }

    .success-message i,
    .error-message i {
        margin-right: 0.75rem;
        font-size: 1.25rem;
    }

    .email-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
    }

    .email-link:hover {
        color: var(--primary-dark);
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .contact-info,
        .contact-form {
            padding: 1.5rem;
        }

        .contact-item {
            padding: 0.75rem;
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
    }
</style>

<section class="contact-section">
    <div class="container">
        <div class="contact-header">
            <h1 class="contact-title">お問い合わせ</h1>
            <p class="contact-subtitle">ご質問やご相談がございましたら、お気軽にお問い合わせください。</p>
        </div>

        @if(session('success'))
            <div class="success-message">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="contact-container">
            <div class="contact-grid">
                <!-- Contact Information -->
                <div class="contact-info">
                    <h3>お問い合わせについて</h3>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-details">
                            <h4>対応時間</h4>
                            <p>平日 9:00 - 18:00</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-reply"></i>
                        </div>
                        <div class="contact-details">
                            <h4>返信について</h4>
                            <p>通常2-3営業日以内にご返信いたします</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="contact-details">
                            <h4>プライバシー</h4>
                            <p>お客様の情報は適切に管理いたします</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div class="contact-details">
                            <h4>よくある質問</h4>
                            <p><a href="{{ route('faq') }}" class="email-link">FAQページ</a>もご確認ください</p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form">
                    <h3 style="color: var(--primary-color); font-size: 1.5rem; font-weight: 600; margin-bottom: 1.5rem;">お問い合わせフォーム</h3>
                    
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="name" class="form-label">お名前 <span style="color: #dc3545;">*</span></label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">メールアドレス <span style="color: #dc3545;">*</span></label>
                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="subject" class="form-label">件名 <span style="color: #dc3545;">*</span></label>
                            <input type="text" id="subject" name="subject" class="form-control @error('subject') is-invalid @enderror" 
                                   value="{{ old('subject') }}" required>
                            @error('subject')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label">メッセージ <span style="color: #dc3545;">*</span></label>
                            <textarea id="message" name="message" class="form-control @error('message') is-invalid @enderror" 
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn-submit">
                            <i class="fas fa-paper-plane me-2"></i>送信する
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = document.querySelector('.btn-submit');
    
    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>送信中...';
    });
});
</script>
@endsection
