@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="h4 mb-0">支援内容の確認</h1>
                </div>
                <div class="card-body">
                    <h5 class="card-title mb-4">{{ $project->title }}</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mb-4">
                        <h6>支援内容</h6>
                        <div class="card">
                            <div class="card-body">
                                @if($reward)
                                    <h6 class="card-subtitle mb-2 text-muted">選択したリワード</h6>
                                    <p class="card-text">{{ $reward->reward_name }}</p>
                                    <p class="card-text">{{ $reward->reward_description }}</p>
                                @else
                                    <p class="card-text">リワードなしの支援</p>
                                @endif
                                <h6 class="mt-3 mb-0">支援金額</h6>
                                <p class="card-text">{{ number_format($amount) }}円</p>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('purchase.store', ['project' => $project->id]) }}">
                        @csrf
                        <input type="hidden" name="amount" value="{{ preg_replace('/[^0-9]/', '', $amount) }}">
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        @if($reward)
                            <input type="hidden" name="reward_id" value="{{ $reward->reward_id }}">
                            <input type="hidden" name="reward_name" value="{{ $reward->reward_name }}">
                        @endif
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('purchase.create', ['project' => $project->id]) }}" class="btn btn-outline-secondary">
                                修正する
                            </a>
                            <button type="submit" class="btn btn-primary">
                                支援を確定する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
