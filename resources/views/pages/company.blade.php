@extends('layouts.app')

@section('content')
<style>
    .company-page {
        background: #f8f9fa;
        min-height: 100vh;
        padding: 2rem 0 6rem;
    }

    .page-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 4rem 0;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
    }

    .page-header h1 {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 700;
        margin-bottom: 1rem;
        position: relative;
        z-index: 2;
    }

    .page-header p {
        font-size: 1.25rem;
        opacity: 0.9;
        position: relative;
        z-index: 2;
    }

    .section-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    .content-section {
        background: white;
        border-radius: 12px;
        padding: 4rem;
        margin: 3rem 0;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    }

    .section-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 3rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid var(--primary-color);
    }

    .section-header-label {
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--primary-color);
        font-weight: 600;
    }

    .section-header h2 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0;
    }

    .company-intro {
        font-size: 1.125rem;
        line-height: 1.9;
        color: var(--text-primary);
        margin-bottom: 2rem;
    }

    .president-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 3rem;
        border-radius: 12px;
        margin: 3rem 0;
    }

    .president-info {
        display: flex;
        gap: 2rem;
        align-items: flex-start;
        margin-top: 2rem;
    }

    .president-name {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-top: 1rem;
        text-align: right;
    }

    .outline-table {
        width: 100%;
        border-collapse: collapse;
        margin: 2rem 0;
        background: white;
    }

    .outline-table tr {
        border-bottom: 1px solid #e9ecef;
    }

    .outline-table tr:last-child {
        border-bottom: none;
    }

    .outline-table td {
        padding: 1.25rem;
        vertical-align: top;
    }

    .outline-table td:first-child {
        font-weight: 600;
        color: var(--primary-color);
        width: 180px;
        background: #f8f9fa;
    }

    .outline-table td:last-child {
        color: var(--text-primary);
        line-height: 1.7;
    }

    .philosophy-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .philosophy-item {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 12px;
        border-left: 4px solid var(--primary-color);
        transition: all 0.3s ease;
    }

    .philosophy-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }

    .philosophy-item h4 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .philosophy-item ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .philosophy-item li {
        padding: 0.5rem 0;
        padding-left: 1.5rem;
        position: relative;
        color: var(--text-primary);
        line-height: 1.7;
    }

    .philosophy-item li::before {
        content: '✓';
        position: absolute;
        left: 0;
        color: var(--primary-color);
        font-weight: bold;
    }

    .office-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .office-card {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 2rem;
        border: 1px solid #e9ecef;
    }

    .office-card h4 {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--primary-color);
    }

    .office-table {
        width: 100%;
        border-collapse: collapse;
    }

    .office-table td {
        padding: 0.75rem 0;
        font-size: 0.9375rem;
        vertical-align: top;
    }

    .office-table td:first-child {
        font-weight: 600;
        color: var(--text-primary);
        width: 100px;
    }

    .office-table td:last-child {
        color: #666;
        line-height: 1.6;
    }

    .cta-section {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 4rem;
        border-radius: 12px;
        text-align: center;
        margin: 3rem 0;
    }

    .cta-section h3 {
        font-size: 1.75rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .cta-section p {
        font-size: 1.125rem;
        opacity: 0.9;
        margin-bottom: 2rem;
        line-height: 1.8;
    }

    .cta-button {
        display: inline-block;
        padding: 1rem 3rem;
        background: var(--secondary-color);
        color: var(--primary-color);
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1.125rem;
        transition: all 0.3s ease;
    }

    .cta-button:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        color: var(--primary-color);
    }

    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.6s ease forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .content-section {
            padding: 2rem 1.5rem;
        }
        
        .section-header h2 {
            font-size: 1.5rem;
        }
        
        .president-info {
            flex-direction: column;
        }

        .philosophy-grid {
            grid-template-columns: 1fr;
        }

        .office-grid {
            grid-template-columns: 1fr;
        }

        .cta-section {
            padding: 2rem 1.5rem;
        }
    }
</style>

<div class="company-page">
    <div class="page-header fade-in">
    <div class="container">
            <h1>企業情報</h1>
            <p>Uknight Cloudについて</p>
        </div>
    </div>

    <div class="section-container">
        <!-- ABOUT Section -->
        <section class="content-section fade-in">
            <div class="section-header">
                <span class="section-header-label">ABOUT</span>
                <h2>Uknight Cloud<br>について</h2>
        </div>

            <p class="company-intro">
                Uknight Cloudは、地域のつながりと多様な挑戦を応援するクラウドファンディングプラットフォームです。<br><br>
                2025年1月に設立された当社は、地域密着型のアプローチで、多くの人々が持つ夢や挑戦を実現するための支援を行っています。八王子地域を中心に活動し、地域の特性を活かしたサービスを提供することで、地域コミュニティの活性化と持続可能な発展を目指しています。<br><br>
                当社が磨き上げてきた独自のプラットフォーム技術と、進化を続けるクラウドファンディングサービスにより、プロジェクト作成者と支援者をつなぐ信頼の橋渡しを実現。地域の重要課題解決において、確かな実績とお客様の信頼を作り上げてきました。<br><br>
                そして今なお、社員一人ひとりが新しい製品や技術開発のために、日々試行錯誤と挑戦を繰り返しています。過去から積み上げてきた信頼を足掛かりとしながら、努力を惜しまず挑戦の心を持ち、日本の地域経済発展に貢献していきます。
            </p>
        </section>

        <!-- GREETING Section -->
        <section class="content-section fade-in">
            <div class="section-header">
                <span class="section-header-label">GREETING</span>
                <h2>代表挨拶</h2>
                    </div>
            
            <div class="president-section">
                <div style="margin-bottom: 2rem;">
                    <p style="font-size: 1.125rem; line-height: 1.9; margin-bottom: 1.5rem;">
                        <strong>モノづくりに情熱と誇りを持ち、<br>
                        お客様に信頼される企業として社会に貢献する</strong>
                    </p>
                    
                    <p style="line-height: 1.9; margin-bottom: 1rem;">
                        Uknight Cloudは2025年の設立以来、地域の起業家、クリエイター、コミュニティリーダーを中心としたお客様に、柔軟な発想で独自のプラットフォーム技術、クラウドファンディングサービスを駆使した支援を開発し提供することで業界と社会の繁栄に寄与してまいりました。
                    </p>
                    
                    <p style="line-height: 1.9; margin-bottom: 1rem;">
                        また、地域の課題解決を支える重要プロジェクトを中心に支援し、その実績を信頼に、信頼を未来への躍進へとスローガンに新たな技術の提案を続けております。
                    </p>
                    
                    <p style="line-height: 1.9; margin-bottom: 2rem;">
                        常にモノづくりに対して挑戦の心を忘れず、先駆者で在り続けることが私どもの使命であり、微力ながら日本の地域経済を躍進させていく力となりたいと新しい技術の開発に取り組んでおります。時代の変化に柔軟に対応し、企業価値を高め、従業員一人ひとりがUknight Cloud社員であることに誇りを持ち続けられる企業に成長していくよう果敢に挑戦し、社会に貢献してまいります。
                    </p>
                </div>

                <div style="text-align: right;">
                    <div class="president-name">Uknight Cloud<br>代表取締役社長</div>
                </div>
                </div>

            <div class="philosophy-grid">
                <div class="philosophy-item">
                    <h4>経営理念</h4>
                    <ul>
                        <li>社員一人ひとりがルールどおりの仕事をし、お客様に安心していただけるサービスを提案、提供する</li>
                        <li>技術で社会を支え、次世代につなぎ、進化させ、お客様にそして地域に愛され続ける企業を目指します</li>
                    </ul>
                </div>
                
                <div class="philosophy-item">
                    <h4>行動規範</h4>
                    <ul>
                        <li>失敗を恐れずチャレンジし続ける</li>
                        <li>先駆者であり続ける</li>
                        <li>「出来ない」ではなく、どうやったら「出来る」のかを考える</li>
                        <li>仕事の中にも楽しみを見出し、分かち合おう</li>
                </ul>
                </div>

                <div class="philosophy-item">
                    <h4>ビジョン</h4>
                    <p style="line-height: 1.9; margin: 0;">
                        自動化、無人化していく製造業の流れをしっかりと汲みつつ、「企業は人なり」の精神を守り、古きよきものは残し、未来へチャレンジし続ける
                    </p>
                </div>
                
                <div class="philosophy-item">
                    <h4>ミッション</h4>
                    <p style="line-height: 1.9; margin: 0;">
                        豊かな発想と創造で、仕事に感動できる環境、多くの人を感動させられる会社を目指す
                    </p>
                </div>
            </div>
        </section>

        <!-- OUTLINE Section -->
        <section class="content-section fade-in">
            <div class="section-header">
                <span class="section-header-label">OUTLINE</span>
                <h2>会社概要</h2>
        </div>
            
            <table class="outline-table">
                <tr>
                    <td>商号</td>
                    <td>Uknight Cloud</td>
                </tr>
                <tr>
                    <td>設立</td>
                    <td>2025年1月</td>
                </tr>
                <tr>
                    <td>資本金</td>
                    <td>1,000万円</td>
                </tr>
                <tr>
                    <td>代表者</td>
                    <td>代表取締役社長</td>
                </tr>
                <tr>
                    <td>所在地</td>
                    <td>
                        〒192-0000<br>
                        東京都八王子市<br>
                        本社：東京都八王子市XX町XX番地
                    </td>
                </tr>
                <tr>
                    <td>事業内容</td>
                    <td>
                        クラウドファンディングプラットフォームの運営<br>
                        プロジェクト支援サービスの提供<br>
                        地域コミュニティの活性化支援
                    </td>
                </tr>
                <tr>
                    <td>主要サービス</td>
                    <td>
                        プロジェクト支援プラットフォーム<br>
                        リターン管理システム<br>
                        支援者・プロジェクト作成者コミュニティ<br>
                        進捗共有機能
                    </td>
                </tr>
            </table>
        </section>

        <!-- Contact CTA -->
        <section class="cta-section fade-in">
            <h3>お問い合わせ</h3>
            <p>
                Uknight Cloudに関するお問い合わせやご相談がございましたら、<br>
                お気軽にお問い合わせください。
            </p>
            <a href="{{ route('contact') }}" class="cta-button">
                <i class="fas fa-envelope me-2"></i>お問い合わせフォーム
            </a>
        </section>
    </div>
</div>

<script>
    // Intersection Observer for fade-in animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, observerOptions);

    document.querySelectorAll('.fade-in').forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });
</script>
@endsection


