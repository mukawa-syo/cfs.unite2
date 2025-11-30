<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ - Uknight Cloud</title>
    <style>
        body {
            font-family: 'Inter', 'Noto Sans JP', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9fafb;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #2A6B51 0%, #1F4F3A 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .content {
            padding: 30px;
        }
        .info-item {
            margin-bottom: 20px;
            padding: 15px;
            background: #f8fafc;
            border-radius: 8px;
            border-left: 4px solid #2A6B51;
        }
        .info-label {
            font-weight: 600;
            color: #2A6B51;
            margin-bottom: 5px;
        }
        .info-value {
            color: #374151;
        }
        .message-content {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            white-space: pre-wrap;
            font-family: inherit;
        }
        .footer {
            background: #f8fafc;
            padding: 20px;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        .footer a {
            color: #2A6B51;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Uknight Cloud お問い合わせ</h1>
        </div>
        
        <div class="content">
            <p>Uknight Cloudにお問い合わせいただき、ありがとうございます。</p>
            
            <div class="info-item">
                <div class="info-label">お名前</div>
                <div class="info-value">{{ $name }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">メールアドレス</div>
                <div class="info-value">{{ $email }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">件名</div>
                <div class="info-value">{{ $subject }}</div>
            </div>
            
            <div class="info-item">
                <div class="info-label">メッセージ</div>
                <div class="message-content">{{ $body ?? $message_text ?? '' }}</div>
            </div>
        </div>
        
        <div class="footer">
            <p>このメールは Uknight Cloud のお問い合わせフォームから送信されました。</p>
            <p><a href="{{ url('/') }}">Uknight Cloud</a> | <a href="{{ url('/contact') }}">お問い合わせ</a></p>
        </div>
    </div>
</body>
</html>





