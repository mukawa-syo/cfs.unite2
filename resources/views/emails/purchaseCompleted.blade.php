<!-- resources/views/emails/purchaseCompleted.blade.php -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>購入完了のお知らせ</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, 'Hiragino Kaku Gothic ProN', 'Hiragino Sans', Meiryo, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .order-info {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .order-detail {
            border-bottom: 1px solid #dee2e6;
            padding: 10px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            color: #6c757d;
            font-size: 0.9em;
        }
        .thank-you {
            font-size: 1.2em;
            color: #28a745;
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>ご購入ありがとうございます</h1>
    </div>

    <div class="thank-you">
        {{ $order->last_name }} {{ $order->first_name }} 様
    </div>

    <p>この度は Unite をご利用いただき、誠にありがとうございます。<br>
    以下の内容で注文を承りましたのでご確認ください。</p>

    <div class="order-info">
        <div class="order-detail">
            <strong>注文番号：</strong><br>
            {{ $order->order_id }}
        </div>
        <div class="order-detail">
            <strong>購入日時：</strong><br>
            {{ $order->order_date->format('Y年m月d日 H:i') }}
        </div>
        <div class="order-detail">
            <strong>プロジェクト：</strong><br>
            @if($order->project)
                {{ $order->project->title }}
            @else
                プロジェクト情報なし
            @endif
        </div>
        <div class="order-detail">
            <strong>購入商品：</strong><br>
            @if($order->reward)
                {{ $order->reward->reward_name }}
            @elseif($order->project)
                通常支援
            @else
                通常購入
            @endif
        </div>
        <div class="order-detail">
            <strong>お届け先：</strong><br>
            〒{{ $order->postal_code }}<br>
            {{ $order->prefecture }}{{ $order->city }}<br>
            {{ $order->address }}<br>
            @if($order->building_name)
            {{ $order->building_name }}
            @endif
        </div>
        <div class="order-detail">
            <strong>支払状態：</strong><br>
            {{ $order->payment_status == 0 ? '未払い' : '支払い完了' }}
        </div>
    </div>

    <p>商品の発送状況や詳細については、マイページの購入履歴からご確認いただけます。</p>

    <p>ご支援ありがとうございました。</p>
    <p>支援金額：{{ number_format($order->amount) }}円</p>

    <div class="footer">
        <p>※このメールは自動送信されています。このメールには返信できません。</p>
        <p>ご不明な点がございましたら、下記のお問い合わせフォームよりご連絡ください。</p>
        <p>Unite カスタマーサポート</p>
    </div>
</body>
</html>
