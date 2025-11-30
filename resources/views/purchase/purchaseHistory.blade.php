<!-- resources/views/purchase/purchaseHistory.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h1 class="h4 mb-0">支援履歴</h1>
                </div>
                <div class="card-body">
                    @if($supports->isEmpty() && $orders->isEmpty())
                        <p class="text-center mb-0">支援履歴がありません。</p>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>日付</th>
                                        <th>プロジェクト</th>
                                        <th>リワード</th>
                                        <th>支援金額</th>
                                        <th>ステータス</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($supports as $support)
                                        <tr>
                                            <td>{{ $support->supported_at->format('Y/m/d H:i') }}</td>
                                            <td>
                                                <a href="{{ route('projects.show', $support->project) }}">
                                                    {{ $support->project->project_name }}
                                                </a>
                                            </td>
                                            <td>
                                                @if($support->reward)
                                                    {{ $support->reward->reward_name }}
                                                @else
                                                    リワードなし
                                                @endif
                                            </td>
                                            <td>{{ number_format($support->amount) }}円</td>
                                            <td>
                                                @if($support->status == 1)
                                                    <span class="badge bg-success">支援完了</span>
                                                @else
                                                    <span class="badge bg-secondary">処理中</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <h2 class="mb-4">購入履歴</h2>
    @if ($orders->isEmpty())
        <div class="alert alert-info">
            まだ購入履歴はありません。
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>注文ID</th>
                        <th>注文日時</th>
                        <th>リワード名</th>
                        <th>金額</th>
                        <th>支払状態</th>
                        <th>詳細</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->order_id }}</td>
                            <td>
                                @if($order->order_date instanceof \DateTime)
                                    {{ $order->order_date->format('Y年m月d日 H:i') }}
                                @else
                                    {{ \Carbon\Carbon::parse($order->order_date)->format('Y年m月d日 H:i') }}
                                @endif
                            </td>
                            <td>{{ $order->rewardDetail->name ?? '不明' }}</td>
                            <td>{{ number_format($order->rewardDetail->price ?? 0) }}円</td>
                            <td>
                                <span class="badge {{ $order->payment_status == 0 ? 'bg-warning' : 'bg-success' }}">
                                    {{ $order->payment_status == 0 ? '未払い' : '支払い完了' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order->order_id) }}" class="btn btn-sm btn-info">
                                    詳細を見る
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
