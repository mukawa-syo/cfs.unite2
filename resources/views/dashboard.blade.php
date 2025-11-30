@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- プロフィールカード -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">プロフィール</h5>
                    <a href="{{ route('dashboard.profile.edit') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-edit"></i> 編集
                    </a>
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ Auth::user()->name }}</h5>
                    <p class="card-text">{{ Auth::user()->email }}</p>
                    @if(Auth::user()->phone_number)
                        <p class="card-text">
                            <small class="text-muted">
                                <i class="fas fa-phone"></i> {{ Auth::user()->phone_number }}
                            </small>
                        </p>
                    @endif
                    @if(Auth::user()->address)
                        <p class="card-text">
                            <small class="text-muted">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ Auth::user()->prefecture }}{{ Auth::user()->city }}{{ Auth::user()->address }}
                                @if(Auth::user()->building_name)
                                    {{ Auth::user()->building_name }}
                                @endif
                            </small>
                        </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- 購入・支援履歴カード -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">購入・支援履歴</h5>
                    <a href="{{ route('dashboard.purchaseHistory') }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-history"></i> 詳細
                    </a>
                </div>
                <div class="card-body">
                    @if(($recentSupports && $recentSupports->isNotEmpty()) || ($recentOrders && $recentOrders->isNotEmpty()))
                        <div class="list-group list-group-flush">
                            @foreach($recentSupports as $support)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1">{{ $support->project->project_name }}</h6>
                                            @if($support->reward)
                                                <p class="mb-1 text-muted">
                                                    <small>{{ $support->reward->reward_name }}</small>
                                                </p>
                                            @endif
                                            <p class="mb-0">
                                                <span class="badge bg-success">¥{{ number_format($support->amount) }}</span>
                                                <span class="badge bg-info">支援</span>
                                            </p>
                                        </div>
                                        <small class="text-muted">{{ $support->supported_at->format('Y年n月j日') }}</small>
                                    </div>
                                </div>
                            @endforeach
                            @foreach($recentOrders as $order)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <h6 class="mb-1">注文 #{{ $order->order_id }}</h6>
                                            <p class="mb-0">
                                                <span class="badge bg-success">¥{{ number_format($order->amount) }}</span>
                                                <span class="badge bg-{{ $order->payment_status === 1 ? 'success' : 'warning' }}">
                                                    {{ $order->payment_status === 1 ? '支払い完了' : '支払い待ち' }}
                                                </span>
                                            </p>
                                        </div>
                                        <small class="text-muted">{{ $order->created_at->format('Y年n月j日') }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center mb-0">購入・支援履歴はありません</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- 統計情報 -->
        <div class="col-md-4 mb-4">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-title text-muted">総支援者数</h6>
                            <h2 class="card-text">{{ number_format($totalSupporters) }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-title text-muted">総支援金額</h6>
                            <h2 class="card-text">¥{{ number_format($totalPledged) }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h6 class="card-title text-muted">更新回数</h6>
                            <h2 class="card-text">{{ number_format($updates) }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- プロジェクト一覧 -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">プロジェクト一覧</h5>
                </div>
                <div class="card-body">
                    @if($projects->isEmpty())
                        <p class="text-center mb-0">プロジェクトがありません。</p>
                    @else
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>プロジェクト名</th>
                                        <th>支援者数</th>
                                        <th>支援総額</th>
                                        <th>達成率</th>
                                        <th>残り日数</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($projects as $project)
                                        <tr>
                                            <td>{{ $project->project_name }}</td>
                                            <td>{{ number_format($project->supporters_count) }}人</td>
                                            <td>¥{{ number_format($project->total_pledge_amount) }}</td>
                                            <td>{{ $project->progress_percentage }}%</td>
                                            <td>{{ $project->remaining_days }}日</td>
                                            <td>
                                                <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-outline-primary">詳細</a>
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

    <!-- 最近の活動 -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">最近の活動</h5>
                </div>
                <div class="card-body">
                    @if($recentActivities->isEmpty())
                        <p class="text-center mb-0">最近の活動はありません。</p>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($recentActivities as $activity)
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between">
                                        <p class="mb-1">{{ $activity->description }}</p>
                                        <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('status'))
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">通知</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('status') }}
            </div>
        </div>
    </div>
@endif

<style>
.timeline {
    position: relative;
    padding: 0;
    list-style: none;
}

.timeline-item {
    position: relative;
    padding-left: 24px;
    padding-bottom: 20px;
}

.timeline-item:before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 2px;
    background-color: #e9ecef;
}

.timeline-item:after {
    content: "";
    position: absolute;
    left: -4px;
    top: 0;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: #007bff;
}

.timeline-content {
    padding: 10px 15px;
    background-color: #f8f9fa;
    border-radius: 4px;
}
</style>
@endsection
