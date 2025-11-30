@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>注文一覧</h1>

        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>注文ID</th>
                        <th>注文日時</th>
                        <th>プロジェクト</th>
                        <th>商品</th>
                        <th>ユーザー</th>
                        <th>金額</th>
                        <th>支払い</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ optional($order->project)->title ?? '-' }}</td>
                            <td>{{ optional($order->reward)->name ?? '-' }}</td>
                            <td>
                                @if($order->user)
                                    {{ $order->user->name }}<br>
                                    <small class="text-muted">{{ $order->user->email }}</small>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ number_format((float)($order->amount ?? 0)) }}円</td>
                            <td>
                                @if((int)($order->payment_status) === \App\Models\Order::PAYMENT_COMPLETED)
                                    <span class="badge bg-success">支払い完了</span>
                                @else
                                    <span class="badge bg-secondary">保留</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">注文がありません</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    </div>
@endsection





