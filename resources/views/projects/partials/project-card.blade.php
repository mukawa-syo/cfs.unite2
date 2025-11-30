<div class="project-card">
    <a href="{{ route('projects.show', $project) }}" class="text-decoration-none">
        @if($project->project_image)
            <!-- DEBUG: Project image path: {{ $project->project_image }} -->
            <!-- DEBUG: Image URL: {{ asset('storage/' . $project->project_image) }} -->
            <img src="{{ asset('storage/' . $project->project_image) }}"
                 alt="{{ $project->project_name }}"
                 class="project-image">
        @else
            <div class="project-image bg-light d-flex align-items-center justify-content-center">
                <i class="fas fa-image fa-3x text-muted"></i>
            </div>
        @endif
        <div class="project-content">
            <h3 class="project-title">{{ $project->project_name }}</h3>
            <p class="project-description">{{ Str::limit($project->description, 100) }}</p>
            <div class="progress">
                <div class="progress-bar" role="progressbar"
                     style="width: {{ $project->progress_percentage }}%"
                     aria-valuenow="{{ $project->progress_percentage }}"
                     aria-valuemin="0"
                     aria-valuemax="100">
                </div>
            </div>
            <div class="project-stats">
                <div class="stat-item">
                    <div class="stat-value">{{ number_format($project->total_pledge_amount) }}円</div>
                    <div class="stat-label">達成額</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">{{ $project->total_backers }}人</div>
                    <div class="stat-label">支援者数</div>
                </div>
            </div>
        </div>
    </a>
</div>