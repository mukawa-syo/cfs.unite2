@extends('layouts.app')

@section('content')
<style>
    .categories-section {
        padding: 5rem 0;
        background: var(--bg-secondary);
    }

    .categories-header {
        text-align: center;
        margin-bottom: 4rem;
    }

    .categories-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .categories-subtitle {
        font-size: 1.25rem;
        color: var(--text-secondary);
        max-width: 600px;
        margin: 0 auto;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .category-card {
        background: var(--bg-primary);
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        box-shadow: var(--shadow-sm);
        position: relative;
        overflow: hidden;
    }

    .category-card::before {
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

    .category-card:hover::before {
        transform: scaleX(1);
    }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
        text-decoration: none;
        color: inherit;
    }

    .category-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: var(--primary-color);
        background: var(--bg-secondary);
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .category-card:hover .category-icon {
        background: var(--primary-color);
        color: var(--secondary-color);
        transform: scale(1.1);
    }

    .category-name {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: var(--text-primary);
    }

    .category-description {
        color: var(--text-secondary);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .category-stats {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
    }

    .stat-item {
        text-align: center;
    }

    .stat-value {
        font-weight: 700;
        color: var(--primary-color);
        font-size: 1.25rem;
        display: block;
    }

    .stat-label {
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .browse-section {
        background: var(--bg-primary);
        padding: 3rem 0;
        margin-top: 4rem;
        border-radius: 20px;
        text-align: center;
    }

    .browse-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .browse-text {
        color: var(--text-secondary);
        margin-bottom: 2rem;
    }

    .browse-btn {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 1rem 2rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .browse-btn:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
        color: white;
    }

    @media (max-width: 768px) {
        .categories-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .category-card {
            padding: 1.5rem;
        }

        .category-icon {
            width: 60px;
            height: 60px;
            font-size: 2rem;
        }

        .category-name {
            font-size: 1.25rem;
        }
    }
</style>

<section class="categories-section">
    <div class="container">
        <div class="categories-header">
            <h1 class="categories-title">カテゴリから探す</h1>
            <p class="categories-subtitle">興味のある分野のプロジェクトを見つけて、新しい挑戦を応援しましょう。</p>
        </div>

        <div class="categories-grid">
            @foreach($categories as $category)
                <a href="{{ route('projects.category', $category->project_category_id) }}" class="category-card">
                    <div class="category-icon">
                        <i class="fas fa-{{ $category->icon ?? 'folder' }}"></i>
                    </div>
                    <h3 class="category-name">{{ $category->category_name }}</h3>
                    <p class="category-description">
                        @if($category->description)
                            {{ $category->description }}
                        @else
                            {{ $category->category_name }}に関するプロジェクトを探してみましょう。
                        @endif
                    </p>
                    <div class="category-stats">
                        <div class="stat-item">
                            <span class="stat-value">{{ $category->projects_count ?? 0 }}</span>
                            <span class="stat-label">プロジェクト</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">新着</span>
                            <span class="stat-label">随時更新</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="browse-section">
            <h3 class="browse-title">すべてのプロジェクトを見る</h3>
            <p class="browse-text">カテゴリに関係なく、すべてのプロジェクトを閲覧できます。</p>
            <a href="{{ route('projects.index') }}" class="browse-btn">
                <i class="fas fa-search me-2"></i>プロジェクト一覧
            </a>
        </div>
    </div>
</section>
@endsection








