@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">決済確認</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>プロジェクト情報</h5>
                            <div class="project-info">
                                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="img-fluid mb-3" style="max-height: 200px;">
                                <h6>{{ $project->title }}</h6>
                                <p class="text-muted">{{ Str::limit($project->description, 100) }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>決済情報</h5>
                            <div class="payment-info">
                                @if($reward)
                                    <div class="mb-3">
                                        <strong>選択したリワード:</strong><br>
                                        {{ $reward->reward_name }}<br>
                                        <span class="text-muted">{{ $reward->reward_description }}</span>
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <strong>支援金額:</strong><br>
                                    <span class="h4 text-primary">¥{{ number_format($amount) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="payment-form">
                        <h5>カード情報</h5>
                        <form id="paymentForm" action="{{ route('purchase.success', ['project' => $project->id]) }}" method="GET">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="cardNumber" class="form-label">カード番号</label>
                                    <input type="text" class="form-control" id="cardNumber" placeholder="4242 4242 4242 4242" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="expiryMonth" class="form-label">有効期限（月）</label>
                                    <select class="form-select" id="expiryMonth" required>
                                        <option value="">月</option>
                                        @for($i = 1; $i <= 12; $i++)
                                            <option value="{{ sprintf('%02d', $i) }}">{{ sprintf('%02d', $i) }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="expiryYear" class="form-label">有効期限（年）</label>
                                    <select class="form-select" id="expiryYear" required>
                                        <option value="">年</option>
                                        @for($i = date('Y'); $i <= date('Y') + 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="cvc" class="form-label">CVC</label>
                                    <input type="text" class="form-control" id="cvc" placeholder="123" maxlength="4" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="cardName" class="form-label">カード名義人</label>
                                    <input type="text" class="form-control" id="cardName" placeholder="TARO YAMADA" required>
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <i class="fas fa-info-circle"></i>
                                <strong>テスト決済:</strong> この決済はテスト環境です。実際の決済は行われません。
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('purchase.create', ['project' => $project->id]) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> 戻る
                                </a>
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fas fa-credit-card"></i> 決済を完了する
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.payment-form {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 0.5rem;
    margin-top: 1rem;
}

.project-info img {
    border-radius: 0.5rem;
}

.payment-info {
    background: white;
    padding: 1rem;
    border-radius: 0.5rem;
    border: 1px solid #dee2e6;
}
</style>

<script>
document.getElementById('paymentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // 簡単なバリデーション
    const cardNumber = document.getElementById('cardNumber').value;
    const expiryMonth = document.getElementById('expiryMonth').value;
    const expiryYear = document.getElementById('expiryYear').value;
    const cvc = document.getElementById('cvc').value;
    const cardName = document.getElementById('cardName').value;
    
    if (!cardNumber || !expiryMonth || !expiryYear || !cvc || !cardName) {
        alert('すべての項目を入力してください。');
        return;
    }
    
    // テスト用のセッションIDを生成
    const sessionId = 'test_session_' + Date.now();
    
    // 決済成功ページにリダイレクト
    window.location.href = this.action + '?session_id=' + sessionId;
});
</script>
@endsection







