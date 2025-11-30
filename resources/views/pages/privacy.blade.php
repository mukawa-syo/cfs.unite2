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
    }
</style>

<section class="legal-section">
    <div class="container">
        <div class="legal-header">
            <h1 class="legal-title">プライバシーポリシー</h1>
            <p class="legal-subtitle">Uknight Cloud プライバシーポリシー</p>
        </div>

        <div class="legal-container">
            <div class="last-updated">
                <i class="fas fa-calendar-alt me-2"></i>最終更新日: 2025年1月1日
            </div>

            <div class="legal-content">
                <h2>1. はじめに</h2>
                <p>Uknight Cloud（以下「当サービス」といいます。）は、ユーザーの個人情報の保護に関する法令を遵守し、個人情報の適切な取扱いを実現するため、以下のプライバシーポリシーを定めます。</p>

                <h2>2. 個人情報の定義</h2>
                <p>個人情報とは、個人情報保護法にいう「個人情報」を指すものとし、生存する個人に関する情報であって、当該情報に含まれる氏名、生年月日、住所、電話番号、連絡先その他の記述等により特定の個人を識別できる情報及び容貌、指紋、声紋にかかるデータ、及び健康保険証の保険者番号などの当該情報単体から特定の個人を識別できる情報（個人識別情報）を指します。</p>

                <h2>3. 個人情報の収集方法</h2>
                <p>当サービスは、ユーザーが利用登録をする際に氏名、生年月日、住所、電話番号、メールアドレス、銀行口座番号、クレジットカード番号、運転免許証番号などの個人情報をお尋ねすることがあります。また、ユーザーと提携先などとの間でなされたユーザーの個人情報を含む取引記録や決済に関する情報を、当サービスの提携先（情報提供元、広告主、広告配信先などを含みます。以下、「提携先」といいます。）などから収集することがあります。</p>

                <h2>4. 個人情報を収集・利用する目的</h2>
                <p>当サービスが個人情報を収集・利用する目的は、以下のとおりです。</p>
                <ul>
                    <li>当サービスサービスの提供・運営のため</li>
                    <li>ユーザーからのお問い合わせに回答するため（本人確認を行うことを含む）</li>
                    <li>ユーザーが利用中のサービスの新機能、更新情報、キャンペーン等及び当サービスが提供する他のサービスの案内のメールを送付するため</li>
                    <li>メンテナンス、重要なお知らせなど必要に応じたご連絡のため</li>
                    <li>利用規約に違反したユーザーや、不正・不当な目的でサービスを利用しようとするユーザーの特定をし、ご利用をお断りするため</li>
                    <li>ユーザーにご自身の登録情報の閲覧・変更・削除・ご利用状況の閲覧を行っていただくため</li>
                    <li>有料サービスにおいて、ユーザーに利用料金を請求するため</li>
                    <li>上記の利用目的に付随する目的</li>
                </ul>

                <h2>5. 利用目的の変更</h2>
                <p>当サービスは、利用目的が変更前と関連性を有すると合理的に認められる場合に限り、個人情報の利用目的を変更するものとします。</p>
                <p>利用目的の変更を行った場合には、変更後の目的について、当サービス所定の方法により、ユーザーに通知し、または本ウェブサイト上に公表するものとします。</p>

                <h2>6. 個人情報の第三者提供</h2>
                <p>当サービスは、次に掲げる場合を除いて、あらかじめユーザーの同意を得ることなく、第三者に個人情報を提供することはありません。ただし、個人情報保護法その他の法令で認められる場合を除きます。</p>
                <ul>
                    <li>人の生命、身体または財産の保護のために必要がある場合であって、本人の同意を得ることが困難であるとき</li>
                    <li>公衆衛生の向上または児童の健全な育成の推進のために特に必要がある場合であって、本人の同意を得ることが困難であるとき</li>
                    <li>国の機関もしくは地方公共団体またはその委託を受けた者が法令の定める事務を遂行することに対して協力する必要がある場合であって、本人の同意を得ることにより当該事務の遂行に支障を及ぼすおそれがあるとき</li>
                    <li>予め次の事項を告知あるいは公表し、かつ当サービスが個人情報保護委員会に届出をしたとき</li>
                </ul>

                <h2>7. 個人情報の開示</h2>
                <p>当サービスは、本人から個人情報の開示を求められたときは、本人に対し、遅滞なくこれを開示します。ただし、開示することにより次のいずれかに該当する場合は、その全部または一部を開示しないこともあり、開示しない決定をした場合には、その旨を遅滞なく通知します。</p>
                <ul>
                    <li>本人または第三者の生命、身体、財産その他の権利利益を害するおそれがある場合</li>
                    <li>当サービスの業務の適正な実施に著しい支障を及ぼすおそれがある場合</li>
                    <li>その他法令に違反することとなる場合</li>
                </ul>

                <h2>8. 個人情報の訂正および削除</h2>
                <p>ユーザーは、当サービスの保有する自己の個人情報が誤った情報である場合には、当サービスが定める手続により、当サービスに対して個人情報の訂正、追加または削除（以下、「訂正等」といいます。）を請求することができます。</p>
                <p>当サービスは、ユーザーから前項の請求を受けてその請求に理由があると判断した場合には、遅滞なく、当該個人情報の訂正等を行うものとします。</p>

                <h2>9. 個人情報の利用停止等</h2>
                <p>当サービスは、本人から、個人情報が、利用目的の範囲を超えて取り扱われているという理由、または不正の手段により取得されたものであるという理由により、その利用の停止または消去（以下、「利用停止等」といいます。）を求められた場合には、遅滞なく必要な調査を行います。</p>
                <p>前項の調査結果に基づき、その請求に理由があると判断した場合には、遅滞なく、当該個人情報の利用停止等を行います。</p>

                <h2>10. プライバシーポリシーの変更</h2>
                <p>本ポリシーの内容は、法令その他本ポリシーに別段の定めのある事項を除いて、ユーザーに通知することなく、変更することができるものとします。</p>
                <p>当サービスが別途定める場合を除いて、変更後のプライバシーポリシーは、本ウェブサイトに掲載したときから効力を生じるものとします。</p>

                <h2>11. お問い合わせ窓口</h2>
                <p>本ポリシーに関するお問い合わせは、下記の窓口までお願いいたします。</p>
                <p><strong>Uknight Cloud お問い合わせ窓口</strong><br>
                お問い合わせフォーム: <a href="{{ route('contact') }}" style="color: var(--primary-color);">お問い合わせページ</a></p>

                <p style="text-align: center; margin-top: 3rem; color: var(--text-secondary);">
                    以上
                </p>
            </div>
        </div>
    </div>
</section>
@endsection








