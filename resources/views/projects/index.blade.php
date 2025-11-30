<!-- resources/views/projects/index.blade.php -->

@extends('layouts.app')

@section('content')
<style>
    /* Page Header - Modern & Refined */
    .page-header {
        background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);
        padding: 4rem 0 3rem;
        border-bottom: 1px solid rgba(229, 231, 235, 0.5);
        margin-bottom: 4rem;
    }

    .page-title {
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 800;
        letter-spacing: -1px;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
    }

    .page-subtitle {
        color: var(--text-secondary);
        font-size: 1.25rem;
        font-weight: 400;
        margin-bottom: 2.5rem;
    }

    .create-btn {
        background: linear-gradient(135deg, var(--secondary-color) 0%, var(--secondary-dark) 100%);
        border: none;
        color: white;
        padding: 1.125rem 2.5rem;
        border-radius: 14px;
        font-weight: 600;
        font-size: 1rem;
        letter-spacing: 0.3px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 4px 12px rgba(245, 224, 179, 0.3);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .create-btn:hover {
        background: linear-gradient(135deg, var(--secondary-dark) 0%, #d4ac7d 100%);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(245, 224, 179, 0.4);
        color: white;
    }

    .create-btn:active {
        transform: translateY(-1px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--bg-primary);
        border-radius: 20px;
        box-shadow: var(--shadow-sm);
    }

    .empty-icon {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        color: white;
        font-size: 3rem;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 1rem;
    }

    .empty-description {
        color: var(--text-secondary);
        margin-bottom: 2rem;
        font-size: 1.125rem;
    }

    /* Project Grid */
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .project-card {
        background: var(--bg-primary);
        border-radius: 20px;
        border: none;
        overflow: hidden;
        transition: all 0.4s ease;
        box-shadow: var(--shadow-sm);
        position: relative;
    }

    .project-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .project-card:hover::before {
        transform: scaleX(1);
    }

    .project-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
    }

    .project-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .project-card:hover .project-image {
        transform: scale(1.05);
    }

    .project-content {
        padding: 1.75rem;
    }

    .project-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 1rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .project-progress {
        margin: 1.5rem 0;
    }

    .progress {
        height: 8px;
        background-color: var(--bg-tertiary);
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-bar {
        background: linear-gradient(90deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    .project-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .project-stat {
        background: var(--bg-secondary);
        border-radius: 12px;
        padding: 1rem;
        text-align: center;
        transition: all 0.3s ease;
    }

    .project-stat:hover {
        background: var(--bg-tertiary);
        transform: translateY(-2px);
    }

    .stat-icon {
        color: var(--primary-color);
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: var(--text-secondary);
        font-size: 0.75rem;
        margin-bottom: 0.25rem;
    }

    .stat-value {
        color: var(--text-primary);
        font-weight: 600;
        font-size: 1rem;
    }

    .project-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .action-btn {
        flex: 1;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .action-btn-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        border: none;
    }

    .action-btn-primary:hover {
        background: linear-gradient(135deg, var(--primary-dark) 0%, #4338ca 100%);
        transform: translateY(-2px);
        color: white;
    }

    .action-btn-secondary {
        background: var(--bg-secondary);
        color: var(--text-secondary);
        border: 1px solid var(--border-color);
    }

    .action-btn-secondary:hover {
        background: var(--bg-tertiary);
        color: var(--text-primary);
        transform: translateY(-2px);
    }

    .dropdown-toggle {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
        padding: 0.75rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .dropdown-toggle:hover {
        background: var(--bg-tertiary);
        color: var(--text-primary);
    }

    .dropdown-menu {
        border: none;
        border-radius: 12px;
        box-shadow: var(--shadow-lg);
        padding: 0.5rem 0;
    }

    .dropdown-item {
        padding: 0.75rem 1.25rem;
        color: var(--text-secondary);
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .dropdown-item:hover {
        background-color: rgba(99, 102, 241, 0.1);
        color: var(--primary-color);
        transform: translateX(4px);
    }

    .dropdown-item.danger {
        color: #dc3545;
    }

    .dropdown-item.danger:hover {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }

    /* Pagination */
    .pagination {
        justify-content: center;
        margin-top: 3rem;
    }

    .page-link {
        border: none;
        color: var(--text-secondary);
        padding: 0.75rem 1rem;
        margin: 0 0.25rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .page-link:hover {
        background-color: var(--primary-color);
        color: white;
        transform: translateY(-2px);
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-header {
            padding: 2rem 0 1rem;
            text-align: center;
        }
        
        .projects-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .project-actions {
            flex-direction: column;
        }
        
        .action-btn {
            width: 100%;
        }
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="page-title">プロジェクト一覧</h1>
                <p class="page-subtitle">あなたの全てのプロジェクトを管理します</p>
        </div>
            <div class="col-md-4 text-md-end">
                <a href="{{ route('projects.create') }}" class="create-btn">
            <i class="fas fa-plus me-2"></i>新規プロジェクト作成
        </a>
            </div>
        </div>
    </div>
</div>

<div class="container mb-3">
    <ul class="nav nav-pills justify-content-center gap-2" style="font-size:1.1rem;">
        @php $filter = request('filter', 'all'); @endphp
        <li class="nav-item">
            <a class="nav-link{{ $filter === 'all' ? ' active' : '' }}" href="?filter=all{{ request('category') ? '&category=' . request('category') : '' }}">すべて</a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ $filter === 'new' ? ' active' : '' }}" href="?filter=new{{ request('category') ? '&category=' . request('category') : '' }}">新着</a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ $filter === 'featured' ? ' active' : '' }}" href="?filter=featured{{ request('category') ? '&category=' . request('category') : '' }}">注目</a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ $filter === 'almost' ? ' active' : '' }}" href="?filter=almost{{ request('category') ? '&category=' . request('category') : '' }}">達成間近</a>
        </li>
    </ul>
</div>

<div class="container mb-4">
    <form method="GET" action="" class="row g-2 align-items-center justify-content-end">
        <div class="col-auto">
            <select name="category" class="form-select" style="min-width:180px;">
                <option value="">すべてのカテゴリ</option>
                @foreach($categories as $category)
                    <option value="{{ $category->project_category_id }}" {{ request('category') == $category->project_category_id ? 'selected' : '' }}>
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-filter me-1"></i>絞り込む
            </button>
        </div>
    </form>
    </div>

<div class="container">
    <!-- プロジェクト一覧 -->
    @if($projects->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-rocket"></i>
            </div>
            <h3 class="empty-title">プロジェクトがありません</h3>
            <p class="empty-description">新しいプロジェクトを作成して、支援を募りましょう。</p>
            <a href="{{ route('projects.create') }}" class="create-btn">
                <i class="fas fa-plus me-2"></i>最初のプロジェクトを作成
            </a>
        </div>
    @else
        <div class="projects-grid">
                @foreach($projects as $project)
                <div class="project-card">
                    <div style="position:relative;">
                        @if($project->image_url)
                            <img src="{{ $project->image_url }}" class="project-image" alt="{{ $project->title }}">
                        @else
                            <div class="project-image bg-light d-flex align-items-center justify-content-center">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif
                        <div style="position:absolute;top:1rem;left:1rem;display:flex;gap:0.5rem;z-index:2;">
                            @if($project->is_featured)
                                <span class="badge bg-warning text-dark">注目</span>
                            @endif
                            @if($project->created_at->gt(now()->subDays(7)))
                                <span class="badge bg-success">新着</span>
                            @endif
                            @php $rate = $project->goal_amount > 0 ? round($project->total_pledge_amount / $project->goal_amount * 100) : 0; @endphp
                            @if($rate >= 80 && $rate < 100)
                                <span class="badge bg-danger">達成間近</span>
                            @endif
                            @if(isset($project->category))
                                <span class="badge bg-primary">{{ $project->category->category_name }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="project-content">
                        <div class="project-title">{{ $project->title }}</div>
                        <div class="project-progress">
                            <div class="progress" style="height:12px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ $rate }}%;background: linear-gradient(90deg,#2563eb,#fbbf24);" aria-valuenow="{{ $rate }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <span class="fw-bold text-primary">{{ $rate }}%</span>
                                <span class="text-muted small">目標: ¥{{ number_format($project->goal_amount) }}</span>
                            </div>
                                        </div>
                        <div class="project-stats d-flex gap-3 mb-2">
                            <div class="project-stat flex-fill text-center">
                                <i class="fas fa-users stat-icon"></i>
                                <div class="stat-label">支援者</div>
                                <div class="stat-value fw-bold">{{ $project->total_backers }}</div>
                            </div>
                            <div class="project-stat flex-fill text-center">
                                <i class="fas fa-calendar-alt stat-icon"></i>
                                <div class="stat-label">締切</div>
                                <div class="stat-value">{{ $project->deadline ? $project->deadline->format('Y/m/d') : '-' }}</div>
                            </div>
                        </div>
                        <a href="{{ route('projects.show', $project) }}" class="btn btn-outline-primary w-100 mt-2">プロジェクトを見る</a>
                    </div>
                </div>
                @endforeach
        </div>

        <!-- ページネーション -->
        @if ($projects instanceof \Illuminate\Pagination\LengthAwarePaginator && $projects->hasPages())
            <div class="d-flex justify-content-center">
                {{ $projects->links() }}
            </div>
        @endif
    @endif
    </div>
@endsection
