<!-- resources/views/projects/show.blade.php -->
@extends('layouts.app')

@section('content')
<style>
    /* Project Header */
    .project-header {
        background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);
        padding: 3rem 0 2rem;
        border-bottom: 1px solid var(--border-color);
    }

    .project-title {
        font-size: clamp(1.75rem, 4vw, 2.5rem);
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1.2;
        margin-bottom: 1rem;
    }

    .project-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .project-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-secondary);
        font-size: 0.875rem;
    }

    .project-meta-item i {
        color: var(--primary-color);
    }

    .creator-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 2px solid var(--primary-light);
    }

    /* Breadcrumb */
    .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 1.5rem;
    }

    .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-item a:hover {
        color: var(--primary-dark);
    }

    .breadcrumb-item.active {
        color: var(--text-secondary);
    }

    /* Share Button */
    .share-btn {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-md);
    }

    .share-btn:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        color: white;
    }

    /* Project Image */
    .project-image-container {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        margin-bottom: 2rem;
    }

    .project-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .project-image-container:hover .project-image {
        transform: scale(1.02);
    }

    /* Content Cards */
    .content-card {
        background: var(--bg-primary);
        border-radius: 16px;
        border: none;
        box-shadow: var(--shadow-sm);
        margin-bottom: 2rem;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .content-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .content-card .card-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        border: none;
        padding: 1.5rem;
    }

    .content-card .card-body {
        padding: 2rem;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .info-item {
        background: var(--bg-secondary);
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid var(--border-color);
    }

    .info-item:hover {
        background: var(--bg-tertiary);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .info-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.25rem;
    }

    .info-label {
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .info-value {
        color: var(--text-primary);
        font-weight: 600;
        font-size: 1.125rem;
    }

    /* Support Sidebar */
    .sticky-support-block {
        position: sticky;
        top: 100px;
        max-height: calc(100vh - 120px);
        overflow-y: auto;
    }
    
    .sticky-support-block::-webkit-scrollbar {
        width: 6px;
    }
    
    .sticky-support-block::-webkit-scrollbar-track {
        background: var(--bg-tertiary);
        border-radius: 3px;
    }
    
    .sticky-support-block::-webkit-scrollbar-thumb {
        background: var(--primary-color);
        border-radius: 3px;
    }
    
    .sticky-support-block::-webkit-scrollbar-thumb:hover {
        background: var(--primary-dark);
    }

    /* Support Card */
    .support-card {
        background: var(--bg-primary);
        border-radius: 20px;
        border: none;
        box-shadow: var(--shadow-lg);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .support-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 2rem;
        text-align: center;
    }

    .support-amount {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .support-target {
        opacity: 0.9;
        font-size: 1rem;
    }

    .support-progress {
        padding: 2rem;
    }

    .progress {
        height: 12px;
        background-color: var(--bg-tertiary);
        border-radius: 6px;
        overflow: hidden;
        margin-bottom: 1rem;
    }

    .progress-bar {
        background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        border-radius: 6px;
        transition: width 0.3s ease;
    }

    .support-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .support-stat {
        text-align: center;
        padding: 1rem;
        background: var(--bg-secondary);
        border-radius: 12px;
    }

    .support-stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        display: block;
    }

    .support-stat-label {
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .support-btn {
        width: 100%;
        padding: 1rem 2rem;
        background: linear-gradient(135deg, var(--secondary-color) 0%, #d97706 100%);
        border: none;
        color: white;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1.125rem;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-md);
    }

    .support-btn:hover {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        color: white;
    }

    .support-btn:disabled {
        background: var(--text-light);
        cursor: not-allowed;
        transform: none;
    }

    /* Rewards Section */
    .rewards-section {
        background: var(--bg-secondary);
        padding: 3rem 0;
        margin-top: 3rem;
    }

    .rewards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .reward-card {
        background: var(--bg-primary);
        border-radius: 16px;
        border: 2px solid var(--border-color);
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: var(--shadow-sm);
    }

    .reward-card:hover {
        border-color: var(--primary-color);
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .reward-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 1.5rem;
        text-align: center;
    }

    .reward-price {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .reward-name {
        font-size: 1.25rem;
        font-weight: 600;
    }

    .reward-body {
        padding: 1.5rem;
    }

    .reward-description {
        color: var(--text-secondary);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .reward-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: var(--bg-secondary);
        border-radius: 8px;
    }

    .reward-delivery {
        color: var(--text-secondary);
        font-size: 0.875rem;
    }

    .reward-btn {
        width: 100%;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border: none;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .reward-btn:hover {
        background: linear-gradient(135deg, var(--primary-dark) 0%, #4338ca 100%);
        transform: translateY(-2px);
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .project-header {
            padding: 2rem 0 1rem;
        }
        
        .project-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }
        
        .info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .support-stats {
            grid-template-columns: 1fr;
        }
        
        .rewards-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Project Header -->
<div class="project-header">
    <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">プロジェクト一覧</a></li>
                <li class="breadcrumb-item active">{{ $project->title }}</li>
                </ol>
            </nav>
        
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="project-title">{{ $project->title }}</h1>
                <div class="project-meta">
                    <div class="project-meta-item">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($project->user->name ?? 'Unknown') }}&background=6366f1&color=ffffff" 
                     alt="{{ $project->user->name ?? 'Unknown' }}" 
                             class="creator-avatar">
                <span>{{ $project->user->name ?? 'Unknown' }}</span>
                    </div>
                    <div class="project-meta-item">
                        <i class="{{ $project->category->icon ?? 'fas fa-folder' }}"></i>
                        <span>{{ $project->category ? $project->category->category_name : '未分類' }}</span>
                    </div>
                    <div class="project-meta-item">
                        <i class="fas fa-calendar"></i>
                        <span>{{ $project->created_at->format('Y年m月d日') }}開始</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
            <div class="dropdown">
                    <button class="share-btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-share-alt me-2"></i>シェア
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($project->title) }}" target="_blank">
                            <i class="fab fa-twitter me-2"></i>Twitter
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank">
                            <i class="fab fa-facebook me-2"></i>Facebook
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="https://line.me/R/msg/text/?{{ urlencode($project->title . ' ' . request()->url()) }}" target="_blank">
                            <i class="fab fa-line me-2"></i>LINE
                        </a>
                </li>
                </ul>
                </div>
            </div>
            </div>
        </div>
    </div>

<div class="container py-4">
    <div class="row">
        <!-- メインコンテンツ -->
        <div class="col-lg-8">
            <!-- プロジェクト画像 -->
            <div class="project-image-container">
                @if($project->image_url)
                    <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="project-image">
                @else
                    <div class="project-image bg-light d-flex align-items-center justify-content-center">
                        <i class="fas fa-image fa-4x text-muted"></i>
                    </div>
                @endif
            </div>

            <!-- プロジェクト概要 -->
            <div class="content-card">
                <div class="card-header">
                    <h2 class="h5 mb-0">
                        <i class="fas fa-info-circle me-2"></i>プロジェクト概要
                    </h2>
                </div>
                <div class="card-body">
                    <p class="mb-0" style="line-height: 1.8; color: var(--text-secondary);">{{ $project->description }}</p>
                </div>
            </div>

            <!-- プロジェクト情報 -->
            <div class="content-card">
                <div class="card-header">
                    <h2 class="h5 mb-0">
                        <i class="fas fa-clipboard-list me-2"></i>プロジェクト情報
                    </h2>
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="info-label">開始日</div>
                            <div class="info-value">{{ $project->created_at->format('Y年m月d日') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-hourglass-end"></i>
                            </div>
                            <div class="info-label">締切日</div>
                            <div class="info-value">{{ $project->deadline->format('Y年m月d日') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="info-label">残り日数</div>
                            <div class="info-value">{{ $project->remaining_days }}日</div>
                        </div>
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <div class="info-label">カテゴリー</div>
                            <div class="info-value">{{ $project->category ? $project->category->category_name : '未分類' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- サイドバー -->
        <div class="col-lg-4">
            <div class="sticky-support-block">
                <!-- 支援状況 -->
                <div class="support-card">
                    <div class="support-header">
                        <div class="support-amount">{{ number_format($project->total_pledge_amount) }}円</div>
                        <div class="support-target">目標金額 {{ number_format($project->goal_amount) }}円</div>
                        </div>
                        
                    <div class="support-progress">
                        <div class="progress">
                            <div class="progress-bar" 
                                 style="width: {{ min(($project->total_pledge_amount / $project->goal_amount) * 100, 100) }}%">
                            </div>
                        </div>

                        <div class="support-stats">
                            <div class="support-stat">
                                <span class="support-stat-value">{{ $project->total_backers }}</span>
                                <span class="support-stat-label">支援者</span>
                            </div>
                            <div class="support-stat">
                                <span class="support-stat-value">{{ $project->remaining_days }}</span>
                                <span class="support-stat-label">残り日数</span>
                            </div>
                        </div>

                        @if($project->isActive())
                            <a href="{{ route('purchase.create', ['project' => $project->id]) }}" 
                               class="support-btn">
                                <i class="fas fa-heart me-2"></i>このプロジェクトを支援する
                            </a>
                        @else
                            <button class="support-btn" disabled>
                                <i class="fas fa-clock me-2"></i>支援期間が終了しました
                            </button>
                        @endif
                    </div>
                </div>
            </div>
                    </div>
                </div>

                <!-- リワード一覧 -->
    @if($project->rewards->count() > 0)
        <section class="rewards-section">
            <div class="container">
                <h2 class="section-title">リワード</h2>
                <div class="rewards-grid">
                            @foreach($project->rewards as $reward)
                        <div class="reward-card">
                            <div class="reward-header">
                                <div class="reward-price">{{ number_format($reward->price_incl_tax) }}円</div>
                                <div class="reward-name">{{ $reward->reward_name }}</div>
                                                </div>
                            <div class="reward-body">
                                <p class="reward-description">{{ $reward->reward_description }}</p>
                                
                                <div class="reward-meta">
                                    <div class="reward-delivery">
                                        <i class="fas fa-shipping-fast me-1"></i>
                                        配送予定: {{ $reward->delivery_schedule->format('Y年m月') }}
                                    </div>
                                </div>
                                
                                @if($project->isActive())
                                    <a href="{{ route('purchase.create', ['project' => $project->id, 'reward' => $reward->reward_id]) }}" 
                                       class="reward-btn">
                                        <i class="fas fa-heart me-2"></i>このリワードを選択
                                    </a>
                                @else
                                    <button class="reward-btn" disabled>
                                        <i class="fas fa-clock me-2"></i>支援期間終了
                                    </button>
                                @endif
                        </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
@endsection
 
