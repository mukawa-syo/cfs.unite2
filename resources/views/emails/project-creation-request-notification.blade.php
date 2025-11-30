<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新しいプロジェクト作成申請</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #228B22, #32CD32);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .info-box {
            background: #f8f9fa;
            border-left: 4px solid #228B22;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #228B22, #32CD32);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 6px;
            margin: 20px 0;
            font-weight: 600;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .reason-box {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 15px;
            margin: 15px 0;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>新しいプロジェクト作成申請</h1>
        </div>
        
        <div class="content">
            <p>Uknight Cloud管理者 様</p>
            
            <p>新しいプロジェクト作成申請が届きました。</p>
            
            <div class="info-box">
                <strong>申請者情報</strong><br>
                お名前：{{ $request->user->name }}<br>
                メールアドレス：{{ $request->user->email }}<br>
                申請日時：{{ $request->created_at->format('Y年m月d日 H:i') }}
            </div>
            
            <h3>申請理由</h3>
            <div class="reason-box">{{ $request->reason }}</div>
            
            <p>以下のリンクから申請内容を確認し、承認または拒否の処理を行ってください。</p>
            
            <a href="{{ url('/manage/project-creation-requests') }}" class="button">
                申請一覧を確認する
            </a>
        </div>
        
        <div class="footer">
            <p>Uknight Cloud - 地域のつながりと挑戦を応援するクラウドファンディング</p>
            <p>このメールは自動送信されています。</p>
        </div>
    </div>
</body>
</html>


