@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- サイドメニュー -->
        <div class="col-md-3">
            <div class="card">
                <div class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-tachometer-alt me-2"></i>ダッシュボード
                    </a>
                    <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-user me-2"></i>プロフィール編集
                    </a>
                    <a href="{{ route('purchase.history') }}" class="list-group-item list-group-item-action active">
                        <i class="fas fa-history me-2"></i>購入履歴
                    </a>
                </div>
            </div>
        </div>

        <!-- メインコンテンツ -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white">
                    <h2 class="card-title mb-0">購入履歴</h2>
                </div>
                <div class="card-body">
                    <div class="projects-grid">
                        @forelse(auth()->user()->orders as $order)
                            @if($order->project)
                                <div class="project-card">
                                    <a href="{{ route('projects.show', $order->project) }}" class="text-decoration-none">
                                        @if($order->project->project_image)
                                            <img src="{{ $order->project->image_url }}" 
                                                 alt="{{ $order->project->project_name }}" 
                                                 class="project-image">
                                        @else
                                            <img src="{{ asset('images/default-project.jpg') }}" 
                                                 alt="Default project image" 
                                                 class="project-image">
                                        @endif
                                        <div class="project-content">
                                            <h3 class="project-title">{{ $order->project->project_name }}</h3>
                                            <div class="order-details">
                                                <div class="order-info">
                                                    <span class="order-label">支援金額:</span>
                                                    <span class="order-value">{{ number_format($order->amount) }}円</span>
                                                </div>
                                                <div class="order-info">
                                                    <span class="order-label">支援日:</span>
                                                    <span class="order-value">{{ $order->created_at->format('Y年m月d日') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @empty
                            <div class="text-center py-4">
                                <p class="text-muted mb-3">購入履歴はありません</p>
                                <a href="{{ route('projects.index') }}" class="btn btn-primary">
                                    プロジェクトを探す
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .project-card {
        background: #ffffff;
        border-radius: 8px;
        border: 1px solid #E5E7EB;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .project-card:hover {
        transform: translateY(-5px);
        border-color: #006837;
    }

    .project-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .project-content {
        padding: 1rem;
    }

    .project-title {
        font-size: 1rem;
        font-weight: 600;
        color: #006837;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .order-details {
        margin-top: 0.5rem;
        padding-top: 0.5rem;
        border-top: 1px solid #E5E7EB;
    }

    .order-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.25rem;
        font-size: 0.875rem;
    }

    .order-label {
        color: #6B7280;
    }

    .order-value {
        font-weight: 600;
        color: #006837;
    }

    .list-group-item.active {
        background-color: #006837;
        border-color: #006837;
    }

    .list-group-item-action:hover {
        background-color: #f8f9fa;
        color: #006837;
    }
</style>
@endsection 

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- サイドメニュー -->
        <div class="col-md-3">
            <div class="card">
                <div class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-tachometer-alt me-2"></i>ダッシュボード
                    </a>
                    <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-user me-2"></i>プロフィール編集
                    </a>
                    <a href="{{ route('purchase.history') }}" class="list-group-item list-group-item-action active">
                        <i class="fas fa-history me-2"></i>購入履歴
                    </a>
                </div>
            </div>
        </div>

        <!-- メインコンテンツ -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white">
                    <h2 class="card-title mb-0">購入履歴</h2>
                </div>
                <div class="card-body">
                    <div class="projects-grid">
                        @forelse(auth()->user()->orders as $order)
                            @if($order->project)
                                <div class="project-card">
                                    <a href="{{ route('projects.show', $order->project) }}" class="text-decoration-none">
                                        @if($order->project->project_image)
                                            <img src="{{ $order->project->image_url }}" 
                                                 alt="{{ $order->project->project_name }}" 
                                                 class="project-image">
                                        @else
                                            <img src="{{ asset('images/default-project.jpg') }}" 
                                                 alt="Default project image" 
                                                 class="project-image">
                                        @endif
                                        <div class="project-content">
                                            <h3 class="project-title">{{ $order->project->project_name }}</h3>
                                            <div class="order-details">
                                                <div class="order-info">
                                                    <span class="order-label">支援金額:</span>
                                                    <span class="order-value">{{ number_format($order->amount) }}円</span>
                                                </div>
                                                <div class="order-info">
                                                    <span class="order-label">支援日:</span>
                                                    <span class="order-value">{{ $order->created_at->format('Y年m月d日') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @empty
                            <div class="text-center py-4">
                                <p class="text-muted mb-3">購入履歴はありません</p>
                                <a href="{{ route('projects.index') }}" class="btn btn-primary">
                                    プロジェクトを探す
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .project-card {
        background: #ffffff;
        border-radius: 8px;
        border: 1px solid #E5E7EB;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .project-card:hover {
        transform: translateY(-5px);
        border-color: #006837;
    }

    .project-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .project-content {
        padding: 1rem;
    }

    .project-title {
        font-size: 1rem;
        font-weight: 600;
        color: #006837;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .order-details {
        margin-top: 0.5rem;
        padding-top: 0.5rem;
        border-top: 1px solid #E5E7EB;
    }

    .order-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.25rem;
        font-size: 0.875rem;
    }

    .order-label {
        color: #6B7280;
    }

    .order-value {
        font-weight: 600;
        color: #006837;
    }

    .list-group-item.active {
        background-color: #006837;
        border-color: #006837;
    }

    .list-group-item-action:hover {
        background-color: #f8f9fa;
        color: #006837;
    }
</style>
@endsection 
 

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- サイドメニュー -->
        <div class="col-md-3">
            <div class="card">
                <div class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-tachometer-alt me-2"></i>ダッシュボード
                    </a>
                    <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-user me-2"></i>プロフィール編集
                    </a>
                    <a href="{{ route('purchase.history') }}" class="list-group-item list-group-item-action active">
                        <i class="fas fa-history me-2"></i>購入履歴
                    </a>
                </div>
            </div>
        </div>

        <!-- メインコンテンツ -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white">
                    <h2 class="card-title mb-0">購入履歴</h2>
                </div>
                <div class="card-body">
                    <div class="projects-grid">
                        @forelse(auth()->user()->orders as $order)
                            @if($order->project)
                                <div class="project-card">
                                    <a href="{{ route('projects.show', $order->project) }}" class="text-decoration-none">
                                        @if($order->project->project_image)
                                            <img src="{{ $order->project->image_url }}" 
                                                 alt="{{ $order->project->project_name }}" 
                                                 class="project-image">
                                        @else
                                            <img src="{{ asset('images/default-project.jpg') }}" 
                                                 alt="Default project image" 
                                                 class="project-image">
                                        @endif
                                        <div class="project-content">
                                            <h3 class="project-title">{{ $order->project->project_name }}</h3>
                                            <div class="order-details">
                                                <div class="order-info">
                                                    <span class="order-label">支援金額:</span>
                                                    <span class="order-value">{{ number_format($order->amount) }}円</span>
                                                </div>
                                                <div class="order-info">
                                                    <span class="order-label">支援日:</span>
                                                    <span class="order-value">{{ $order->created_at->format('Y年m月d日') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @empty
                            <div class="text-center py-4">
                                <p class="text-muted mb-3">購入履歴はありません</p>
                                <a href="{{ route('projects.index') }}" class="btn btn-primary">
                                    プロジェクトを探す
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .project-card {
        background: #ffffff;
        border-radius: 8px;
        border: 1px solid #E5E7EB;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .project-card:hover {
        transform: translateY(-5px);
        border-color: #006837;
    }

    .project-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .project-content {
        padding: 1rem;
    }

    .project-title {
        font-size: 1rem;
        font-weight: 600;
        color: #006837;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .order-details {
        margin-top: 0.5rem;
        padding-top: 0.5rem;
        border-top: 1px solid #E5E7EB;
    }

    .order-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.25rem;
        font-size: 0.875rem;
    }

    .order-label {
        color: #6B7280;
    }

    .order-value {
        font-weight: 600;
        color: #006837;
    }

    .list-group-item.active {
        background-color: #006837;
        border-color: #006837;
    }

    .list-group-item-action:hover {
        background-color: #f8f9fa;
        color: #006837;
    }
</style>
@endsection 

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- サイドメニュー -->
        <div class="col-md-3">
            <div class="card">
                <div class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-tachometer-alt me-2"></i>ダッシュボード
                    </a>
                    <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-user me-2"></i>プロフィール編集
                    </a>
                    <a href="{{ route('purchase.history') }}" class="list-group-item list-group-item-action active">
                        <i class="fas fa-history me-2"></i>購入履歴
                    </a>
                </div>
            </div>
        </div>

        <!-- メインコンテンツ -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white">
                    <h2 class="card-title mb-0">購入履歴</h2>
                </div>
                <div class="card-body">
                    <div class="projects-grid">
                        @forelse(auth()->user()->orders as $order)
                            @if($order->project)
                                <div class="project-card">
                                    <a href="{{ route('projects.show', $order->project) }}" class="text-decoration-none">
                                        @if($order->project->project_image)
                                            <img src="{{ $order->project->image_url }}" 
                                                 alt="{{ $order->project->project_name }}" 
                                                 class="project-image">
                                        @else
                                            <img src="{{ asset('images/default-project.jpg') }}" 
                                                 alt="Default project image" 
                                                 class="project-image">
                                        @endif
                                        <div class="project-content">
                                            <h3 class="project-title">{{ $order->project->project_name }}</h3>
                                            <div class="order-details">
                                                <div class="order-info">
                                                    <span class="order-label">支援金額:</span>
                                                    <span class="order-value">{{ number_format($order->amount) }}円</span>
                                                </div>
                                                <div class="order-info">
                                                    <span class="order-label">支援日:</span>
                                                    <span class="order-value">{{ $order->created_at->format('Y年m月d日') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @empty
                            <div class="text-center py-4">
                                <p class="text-muted mb-3">購入履歴はありません</p>
                                <a href="{{ route('projects.index') }}" class="btn btn-primary">
                                    プロジェクトを探す
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .project-card {
        background: #ffffff;
        border-radius: 8px;
        border: 1px solid #E5E7EB;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .project-card:hover {
        transform: translateY(-5px);
        border-color: #006837;
    }

    .project-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .project-content {
        padding: 1rem;
    }

    .project-title {
        font-size: 1rem;
        font-weight: 600;
        color: #006837;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .order-details {
        margin-top: 0.5rem;
        padding-top: 0.5rem;
        border-top: 1px solid #E5E7EB;
    }

    .order-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.25rem;
        font-size: 0.875rem;
    }

    .order-label {
        color: #6B7280;
    }

    .order-value {
        font-weight: 600;
        color: #006837;
    }

    .list-group-item.active {
        background-color: #006837;
        border-color: #006837;
    }

    .list-group-item-action:hover {
        background-color: #f8f9fa;
        color: #006837;
    }
</style>
@endsection 
 

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- サイドメニュー -->
        <div class="col-md-3">
            <div class="card">
                <div class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-tachometer-alt me-2"></i>ダッシュボード
                    </a>
                    <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-user me-2"></i>プロフィール編集
                    </a>
                    <a href="{{ route('purchase.history') }}" class="list-group-item list-group-item-action active">
                        <i class="fas fa-history me-2"></i>購入履歴
                    </a>
                </div>
            </div>
        </div>

        <!-- メインコンテンツ -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white">
                    <h2 class="card-title mb-0">購入履歴</h2>
                </div>
                <div class="card-body">
                    <div class="projects-grid">
                        @forelse(auth()->user()->orders as $order)
                            @if($order->project)
                                <div class="project-card">
                                    <a href="{{ route('projects.show', $order->project) }}" class="text-decoration-none">
                                        @if($order->project->project_image)
                                            <img src="{{ $order->project->image_url }}" 
                                                 alt="{{ $order->project->project_name }}" 
                                                 class="project-image">
                                        @else
                                            <img src="{{ asset('images/default-project.jpg') }}" 
                                                 alt="Default project image" 
                                                 class="project-image">
                                        @endif
                                        <div class="project-content">
                                            <h3 class="project-title">{{ $order->project->project_name }}</h3>
                                            <div class="order-details">
                                                <div class="order-info">
                                                    <span class="order-label">支援金額:</span>
                                                    <span class="order-value">{{ number_format($order->amount) }}円</span>
                                                </div>
                                                <div class="order-info">
                                                    <span class="order-label">支援日:</span>
                                                    <span class="order-value">{{ $order->created_at->format('Y年m月d日') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @empty
                            <div class="text-center py-4">
                                <p class="text-muted mb-3">購入履歴はありません</p>
                                <a href="{{ route('projects.index') }}" class="btn btn-primary">
                                    プロジェクトを探す
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .project-card {
        background: #ffffff;
        border-radius: 8px;
        border: 1px solid #E5E7EB;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .project-card:hover {
        transform: translateY(-5px);
        border-color: #006837;
    }

    .project-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .project-content {
        padding: 1rem;
    }

    .project-title {
        font-size: 1rem;
        font-weight: 600;
        color: #006837;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .order-details {
        margin-top: 0.5rem;
        padding-top: 0.5rem;
        border-top: 1px solid #E5E7EB;
    }

    .order-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.25rem;
        font-size: 0.875rem;
    }

    .order-label {
        color: #6B7280;
    }

    .order-value {
        font-weight: 600;
        color: #006837;
    }

    .list-group-item.active {
        background-color: #006837;
        border-color: #006837;
    }

    .list-group-item-action:hover {
        background-color: #f8f9fa;
        color: #006837;
    }
</style>
@endsection 

@section('content')
<div class="container py-4">
    <div class="row">
        <!-- サイドメニュー -->
        <div class="col-md-3">
            <div class="card">
                <div class="list-group list-group-flush">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-tachometer-alt me-2"></i>ダッシュボード
                    </a>
                    <a href="{{ route('profile.edit') }}" class="list-group-item list-group-item-action">
                        <i class="fas fa-user me-2"></i>プロフィール編集
                    </a>
                    <a href="{{ route('purchase.history') }}" class="list-group-item list-group-item-action active">
                        <i class="fas fa-history me-2"></i>購入履歴
                    </a>
                </div>
            </div>
        </div>

        <!-- メインコンテンツ -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-white">
                    <h2 class="card-title mb-0">購入履歴</h2>
                </div>
                <div class="card-body">
                    <div class="projects-grid">
                        @forelse(auth()->user()->orders as $order)
                            @if($order->project)
                                <div class="project-card">
                                    <a href="{{ route('projects.show', $order->project) }}" class="text-decoration-none">
                                        @if($order->project->project_image)
                                            <img src="{{ $order->project->image_url }}" 
                                                 alt="{{ $order->project->project_name }}" 
                                                 class="project-image">
                                        @else
                                            <img src="{{ asset('images/default-project.jpg') }}" 
                                                 alt="Default project image" 
                                                 class="project-image">
                                        @endif
                                        <div class="project-content">
                                            <h3 class="project-title">{{ $order->project->project_name }}</h3>
                                            <div class="order-details">
                                                <div class="order-info">
                                                    <span class="order-label">支援金額:</span>
                                                    <span class="order-value">{{ number_format($order->amount) }}円</span>
                                                </div>
                                                <div class="order-info">
                                                    <span class="order-label">支援日:</span>
                                                    <span class="order-value">{{ $order->created_at->format('Y年m月d日') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @empty
                            <div class="text-center py-4">
                                <p class="text-muted mb-3">購入履歴はありません</p>
                                <a href="{{ route('projects.index') }}" class="btn btn-primary">
                                    プロジェクトを探す
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .project-card {
        background: #ffffff;
        border-radius: 8px;
        border: 1px solid #E5E7EB;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .project-card:hover {
        transform: translateY(-5px);
        border-color: #006837;
    }

    .project-image {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }

    .project-content {
        padding: 1rem;
    }

    .project-title {
        font-size: 1rem;
        font-weight: 600;
        color: #006837;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .order-details {
        margin-top: 0.5rem;
        padding-top: 0.5rem;
        border-top: 1px solid #E5E7EB;
    }

    .order-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.25rem;
        font-size: 0.875rem;
    }

    .order-label {
        color: #6B7280;
    }

    .order-value {
        font-weight: 600;
        color: #006837;
    }

    .list-group-item.active {
        background-color: #006837;
        border-color: #006837;
    }

    .list-group-item-action:hover {
        background-color: #f8f9fa;
        color: #006837;
    }
</style>
@endsection 
 