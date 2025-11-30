@extends('layouts.app')

@section('content')
<style>
    .legal-section {
        padding: 5rem 0;
        background: var(--bg-secondary);
    }

    .legal-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .legal-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .legal-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .legal-subtitle {
        font-size: 1.125rem;
        color: var(--text-secondary);
    }

    .legal-content {
        background: var(--bg-primary);
        border-radius: 20px;
        padding: 3rem;
        box-shadow: var(--shadow-sm);
        line-height: 1.8;
    }

    .legal-content h2 {
        color: var(--primary-color);
        font-size: 1.5rem;
        font-weight: 600;
        margin: 2rem 0 1rem 0;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--primary-color);
    }

    .legal-content h2:first-child {
        margin-top: 0;
    }

    .legal-content h3 {
        color: var(--text-primary);
        font-size: 1.25rem;
        font-weight: 600;
        margin: 1.5rem 0 0.75rem 0;
    }

    .legal-content p {
        color: var(--text-primary);
        margin-bottom: 1rem;
    }

    .legal-content ul, .legal-content ol {
        color: var(--text-primary);
        margin-bottom: 1rem;
        padding-left: 1.5rem;
    }

    .legal-content li {
        margin-bottom: 0.5rem;
    }

    .legal-content strong {
        color: var(--primary-color);
        font-weight: 600;
    }

    .info-table {
        width: 100%;
        border-collapse: collapse;
        margin: 1.5rem 0;
        background: var(--bg-secondary);
        border-radius: 12px;
        overflow: hidden;
    }

    .info-table th {
        background: var(--primary-color);
        color: white;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        width: 30%;
    }

    .info-table td {
        padding: 1rem;
        color: var(--text-primary);
        border-bottom: 1px solid var(--border-color);
    }

    .info-table tr:last-child td {
        border-bottom: none;
    }

    .last-updated {
        background: var(--bg-secondary);
        padding: 1rem 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        text-align: center;
        color: var(--text-secondary);
        font-size: 0.875rem;
    }

    @media (max-width: 768px) {
        .legal-content {
            padding: 2rem 1.5rem;
        }
        
        .legal-content h2 {
            font-size: 1.25rem;
        }
        
        .legal-content h3 {
            font-size: 1.125rem;
        }

        .info-table th,
        .info-table td {
            padding: 0.75rem;
            font-size: 0.875rem;
        }
    }
</style>

<section class="legal-section">
    <div class="container">
        <div class="legal-header">
            <h1 class="legal-title">特定商取引法に基づく表記</h1>
            <p class="legal-subtitle">Uknight Cloud 特定商取引法に関する表記</p>
        </div>

        <div class="legal-container">
            <div class="last-updated">
                <i class="fas fa-calendar-alt me-2"></i>最終更新日: 2025年1月1日
            </div>

            <div class="legal-content">
                <h2>特定商取引法に基づく表記</h2>
                <p>Uknight Cloud（以下「当サービス」）は、特定商取引に関する法律（特定商取引法）に基づき、以下の通り表記いたします。</p>

                <table class="info-table">
                    <tr>
                        <th>販売業者</th>
                        <td>Uknight Cloud</td>
                    </tr>
                    <tr>
                        <th>運営責任者</th>
                        <td>Uknight Cloud運営事務局</td>
                    </tr>
                    <tr>
                        <th>所在地</th>
                        <td>〒192-0000<br>東京都八王子市</td>
                    </tr>
                    <tr>
                        <th>電話番号</th>
                        <td>お問い合わせフォームよりご連絡ください</td>
                    </tr>
                    <tr>
                        <th>メールアドレス</th>
                        <td>お問い合わせフォームよりご連絡ください</td>
                    </tr>
                    <tr>
                        <th>ウェブサイトURL</th>
                        <td>{{ url('/') }}</td>
                    </tr>
                    <tr>
                        <th>商品・サービス名</th>
                        <td>クラウドファンディングプラットフォーム「Uknight Cloud」</td>
                    </tr>
                    <tr>
                        <th>販売価格</th>
                        <td>各プロジェクトページに記載</td>
                    </tr>
                    <tr>
                        <th>商品代金以外の必要料金</th>
                        <td>送料、手数料等は各プロジェクトにより異なります</td>
                    </tr>
                    <tr>
                        <th>支払方法</th>
                        <td>クレジットカード決済、銀行振込等</td>
                    </tr>
                    <tr>
                        <th>支払時期</th>
                        <td>プロジェクト支援時（即時決済）</td>
                    </tr>
                    <tr>
                        <th>商品の引渡時期</th>
                        <td>各プロジェクトのリターン内容により異なります</td>
                    </tr>
                    <tr>
                        <th>返品・交換について</th>
                        <td>プロジェクトの性質上、原則として返品・交換はできません</td>
                    </tr>
                </table>

                <h2>クラウドファンディングについて</h2>
                <p>当サービスはクラウドファンディングプラットフォームであり、以下の点にご注意ください。</p>

                <h3>プロジェクトの性質</h3>
                <ul>
                    <li>クラウドファンディングは、プロジェクトの実現を支援する仕組みです</li>
                    <li>支援は寄付的な性質があり、必ずしも商品やサービスの提供を保証するものではありません</li>
                    <li>プロジェクトが目標金額に達しない場合、支援金は返金されます</li>
                    <li>プロジェクトが目標金額に達した場合でも、プロジェクトの実現が困難になった場合は、リターンの提供が遅延または変更される可能性があります</li>
                </ul>

                <h3>リスクについて</h3>
                <ul>
                    <li>プロジェクトの実現には様々なリスクが伴います</li>
                    <li>プロジェクトの進捗状況や結果について、当サービスは一切の責任を負いません</li>
                    <li>支援前にプロジェクトの内容を十分にご確認ください</li>
                </ul>

                <h2>免責事項</h2>
                <p>当サービスは、以下の事項について一切の責任を負いません。</p>
                <ul>
                    <li>プロジェクトの実現可能性</li>
                    <li>プロジェクトの進捗状況</li>
                    <li>リターンの品質や内容</li>
                    <li>プロジェクト作成者と支援者間のトラブル</li>
                    <li>プロジェクトの遅延や中止</li>
                </ul>

                <h2>お問い合わせ</h2>
                <p>特定商取引法に関するお問い合わせは、<a href="{{ route('contact') }}" style="color: var(--primary-color);">お問い合わせフォーム</a>よりご連絡ください。</p>

                <p style="text-align: center; margin-top: 3rem; color: var(--text-secondary);">
                    以上
                </p>
            </div>
        </div>
    </div>
</section>
@endsection








