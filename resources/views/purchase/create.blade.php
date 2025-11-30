@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="h3 mb-4">支援内容の確認</h1>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form id="purchaseForm" action="{{ route('purchase.confirm.post', ['project' => $project->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        
                        <!-- リワード選択 -->
                        <div class="mb-4">
                            <label for="reward" class="form-label">リワードの選択</label>
                            <select class="form-select @error('reward_id') is-invalid @enderror" id="reward" name="reward_id">
                                <option value="">リワードなし（任意の金額で支援）</option>
                                @foreach($rewards as $reward)
                                    <option value="{{ $reward->reward_id }}" 
                                            data-price="{{ $reward->price_incl_tax }}"
                                            {{ old('reward_id', request('reward')) == $reward->reward_id ? 'selected' : '' }}>
                                        {{ $reward->reward_name }} ({{ number_format($reward->price_incl_tax) }}円)
                                    </option>
                                @endforeach
                            </select>
                            @error('reward_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- 支援金額 -->
                        <div class="mb-4">
                            <label for="amount" class="form-label">支援金額</label>
                            <div class="input-group">
                                <input type="number" 
                                       class="form-control @error('amount') is-invalid @enderror" 
                                       id="amount" 
                                       name="amount" 
                                       min="1000" 
                                       step="1000" 
                                       value="{{ old('amount', request('reward') && ($reward = $rewards->find(request('reward'))) ? $reward->price_incl_tax : 1000) }}"
                                       {{ request('reward') ? 'readonly' : '' }}
                                       required>
                                <span class="input-group-text">円</span>
                            </div>
                            <div class="form-text" id="amountHelp">{{ request('reward') ? 'リワードが選択されているため、金額は固定されています' : '最低支援金額は1,000円です' }}</div>
                            @error('amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- 利用規約への同意 -->
                        <div class="mb-4">
                            <div class="form-check">
                                <input type="checkbox" 
                                       class="form-check-input @error('agree_terms') is-invalid @enderror" 
                                       id="agree_terms" 
                                       name="agree_terms" 
                                       required 
                                       {{ old('agree_terms') ? 'checked' : '' }}>
                                <label class="form-check-label" for="agree_terms">
                                    <a href="{{ route('terms') }}" target="_blank" class="text-decoration-none">利用規約</a>に同意する
                                </label>
                                @error('agree_terms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-check me-2"></i>確認画面へ進む
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function setAmount(amount, isFixed) {
    const amountInput = document.getElementById('amount');
    const amountHelp = document.getElementById('amountHelp');
    
    amountInput.value = amount;
    amountInput.readOnly = isFixed;
    amountInput.style.backgroundColor = isFixed ? '#e9ecef' : '';
    amountHelp.textContent = isFixed ? 
        'リワードが選択されているため、金額は固定されています' : 
        '最低支援金額は1,000円です';
}

// リワード選択時の処理
document.getElementById('reward').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    
    if (selectedOption && selectedOption.value) {
        const price = parseInt(selectedOption.dataset.price);
        console.log('Selected reward:', {
            id: selectedOption.value,
            price: price
        });
        setAmount(price, true);
    } else {
        setAmount(1000, false);
    }
});

// 初期表示時の処理
document.addEventListener('DOMContentLoaded', function() {
    const select = document.getElementById('reward');
    const selectedOption = select.options[select.selectedIndex];

    if (selectedOption && selectedOption.value) {
        const price = parseInt(selectedOption.dataset.price);
        console.log('Initial reward:', {
            id: selectedOption.value,
            price: price
        });
        setAmount(price, true);
    } else {
        setAmount(1000, false);
    }
});

// フォーム送信前の検証
document.getElementById('purchaseForm').addEventListener('submit', function(e) {
    const amountInput = document.getElementById('amount');
    const amount = parseInt(amountInput.value);
    const selectedOption = document.getElementById('reward').options[document.getElementById('reward').selectedIndex];
    const agreeTerms = document.getElementById('agree_terms');
    
    if (!agreeTerms.checked) {
        e.preventDefault();
        alert('利用規約への同意が必要です。');
        return;
    }
    
    if (selectedOption && selectedOption.value) {
        const rewardPrice = parseInt(selectedOption.dataset.price);
        if (amount < rewardPrice) {
            e.preventDefault();
            alert('選択されたリワードの金額以上の支援金額を入力してください。');
            amountInput.value = rewardPrice;
            return;
        }
    } else if (amount < 1000) {
        e.preventDefault();
        alert('最低支援金額は1,000円です。');
        amountInput.value = 1000;
        return;
    }
});
</script>
@endpush

<script>
function setAmount(amount, isFixed) {
    const amountInput = document.getElementById('amount');
    const amountHelp = document.getElementById('amountHelp');
    amountInput.value = amount;
    amountInput.readOnly = isFixed;
    amountInput.style.backgroundColor = isFixed ? '#e9ecef' : '';
    amountHelp.textContent = isFixed ?
        'リワードが選択されているため、金額は固定されています' :
        '最低支援金額は1,000円です';
}
</script>
