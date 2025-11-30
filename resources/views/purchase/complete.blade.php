@extends('layouts.app')

@section('content')
<div class="container">
    <h1>購入完了</h1>
    <p>プロジェクト「{{ $project->project_name }}」への支援が完了しました。</p>
    <a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary">プロジェクト詳細へ戻る</a>
</div>
@endsection
