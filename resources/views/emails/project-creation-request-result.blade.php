<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロジェクト作成申請の審査結果</title>
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
            background: {{ $isApproved ? 'linear-gradient(135deg, #228B22, #32CD32)' : 'linear-gradient(135deg, #dc3545, #c82333)' }};
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
        .result-box {
            background: {{ $isApproved ? '#d4edda' : '#f8d7da' }};
            border-left: 4px solid {{ $isApproved ? '#28a745' : '#dc3545' }};
            padding: 20px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .result-box h2 {
            margin: 0 0 10px 0;
            color: {{ $isApproved ? '#155724' : '#721c24' }};
        }
        .result-box p {
            margin: 0;
            color: {{ $isApproved ? '#155724' : '#721c24' }};
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
        .comment-box {
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
            <h1>
                @if($isApproved)
                    ✓ プロジェクト作成申請が承認されました
                @else
                    × プロジェクト作成申請の審査結果
                @endif
            </h1>
        </div>
        
        <div class="content">
            <p>{{ $request->user->name }} 様</p>
            
            @if($isApproved)
                <div class="result-box">
                    <h2>🎉 申請が承認されました！</h2>
                    <p>プロジェクト作成の承認をお受けいただきありがとうございます。</p>
                </div>
                
                <p>これより、Uknight Cloudにてプロジェクトを作成いただけるようになりました。</p>
                <p>以下のリンクから、新しいプロジェクトを作成してください。</p>
                
                <a href="{{ url('/projects/create') }}" class="button">
                    プロジェクトを作成する
                </a>
            @else
                <div class="result-box">
                    <h2>申し訳ございません</h2>
                    <p>今回は申請内容を十分に審査いたしましたが、承認を見送らせていただきました。</p>
                </div>
                
                @if($request->comment)
                    <h3>拒否理由</h3>
                    <div class="comment-box">{{ $request->comment }}</div>
                @endif
                
                <p>なお、改善後再度申請していただくことは可能です。</p>
                <p>ご不明な点がございましたら、お気軽にお問い合わせください。</p>
                
                <a href="{{ url('/project-creation-requests/create') }}" class="button">
                    再申請する
                </a>
            @endif
        </div>
        
        <div class="footer">
            <p>Uknight Cloud - 地域のつながりと挑戦を応援するクラウドファンディング</p>
            <p>このメールは自動送信されています。</p>
        </div>
    </div>
</body>
</html>


