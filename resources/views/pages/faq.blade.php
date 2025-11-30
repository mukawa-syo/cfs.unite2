@extends('layouts.app')

@section('content')
<style>
    .faq-section {
        padding: 5rem 0;
        background: var(--bg-secondary);
    }

    .faq-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .faq-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .faq-subtitle {
        font-size: 1.25rem;
        color: var(--text-secondary);
        max-width: 600px;
        margin: 0 auto;
    }

    .faq-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .faq-item {
        background: var(--bg-primary);
        border-radius: 16px;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .faq-item:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .faq-question {
        padding: 1.5rem 2rem;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        font-weight: 600;
        font-size: 1.125rem;
        cursor: pointer;
        position: relative;
        transition: all 0.3s ease;
    }

    .faq-question:hover {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-color) 100%);
    }

    .faq-question::after {
        content: '+';
        position: absolute;
        right: 2rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.5rem;
        font-weight: 300;
        transition: transform 0.3s ease;
    }

    .faq-item.active .faq-question::after {
        transform: translateY(-50%) rotate(45deg);
    }

    .faq-answer {
        padding: 0 2rem;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease;
        background: var(--bg-primary);
    }

    .faq-item.active .faq-answer {
        padding: 1.5rem 2rem;
        max-height: 500px;
    }

    .faq-answer p {
        color: var(--text-primary);
        line-height: 1.7;
        margin: 0;
    }

    .contact-section {
        background: var(--bg-primary);
        padding: 3rem 0;
        margin-top: 4rem;
        border-radius: 20px;
        text-align: center;
    }

    .contact-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .contact-text {
        color: var(--text-secondary);
        margin-bottom: 2rem;
    }

    .contact-btn {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 1rem 2rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .contact-btn:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
        color: white;
    }

    @media (max-width: 768px) {
        .faq-question {
            padding: 1.25rem 1.5rem;
            font-size: 1rem;
        }

        .faq-question::after {
            right: 1.5rem;
        }

        .faq-item.active .faq-answer {
            padding: 1.25rem 1.5rem;
        }
    }
</style>

<section class="faq-section">
    <div class="container">
        <div class="faq-header">
            <h1 class="faq-title">よくある質問</h1>
            <p class="faq-subtitle">Uknight Cloudについて、よくお寄せいただく質問と回答をご紹介します。</p>
        </div>

        <div class="faq-container">
            @foreach($faqs as $index => $faq)
                <div class="faq-item" data-faq="{{ $index }}">
                    <div class="faq-question">
                        {{ $faq['question'] }}
                    </div>
                    <div class="faq-answer">
                        <p>{{ $faq['answer'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="contact-section">
            <h3 class="contact-title">まだ質問がありますか？</h3>
            <p class="contact-text">お探しの情報が見つからない場合は、お気軽にお問い合わせください。</p>
            <a href="#" class="contact-btn">
                <i class="fas fa-envelope me-2"></i>お問い合わせ
            </a>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', function() {
            // Close other open items
            faqItems.forEach(otherItem => {
                if (otherItem !== item && otherItem.classList.contains('active')) {
                    otherItem.classList.remove('active');
                }
            });
            
            // Toggle current item
            item.classList.toggle('active');
        });
    });
});
</script>
@endsection








