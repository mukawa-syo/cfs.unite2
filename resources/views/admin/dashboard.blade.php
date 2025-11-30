@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">管理者ダッシュボード</h1>

    <!-- 統計情報 -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-600">総ユーザー数</h3>
            <p class="text-3xl font-bold">{{ number_format($stats['total_users']) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-600">総プロジェクト数</h3>
            <p class="text-3xl font-bold">{{ number_format($stats['total_projects']) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-600">総支援数</h3>
            <p class="text-3xl font-bold">{{ number_format($stats['total_supports']) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-600">総注文数</h3>
            <p class="text-3xl font-bold">{{ number_format($stats['total_orders']) }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-600">総支援金額</h3>
            <p class="text-3xl font-bold">¥{{ number_format($stats['total_amount']) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- 最近のプロジェクト -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold">最近のプロジェクト</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($recentProjects as $project)
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold">{{ $project->project_name }}</h3>
                            <p class="text-sm text-gray-600">{{ $project->category->category_name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">{{ $project->created_at->format('Y/m/d') }}</p>
                            <p class="text-sm font-semibold">¥{{ number_format($project->target_pledge_amount) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- 最近の支援 -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold">最近の支援</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($recentSupports as $support)
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold">{{ $support->user->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $support->project->project_name }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">{{ $support->supported_at->format('Y/m/d') }}</p>
                            <p class="text-sm font-semibold">¥{{ number_format($support->amount) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- 最近の注文 -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold">最近の注文</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($recentOrders as $order)
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold">{{ $order->user->name }}</h3>
                            <p class="text-sm text-gray-600">注文ID: {{ $order->order_id }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">{{ $order->order_date->format('Y/m/d') }}</p>
                            <p class="text-sm font-semibold">¥{{ number_format($order->amount) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- 最近のログイン -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold">最近のログイン</h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($recentLogins as $login)
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold">{{ $login->user->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $login->ip_address }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">{{ $login->login_at->format('Y/m/d H:i') }}</p>
                            <p class="text-sm {{ $login->is_successful ? 'text-green-600' : 'text-red-600' }}">
                                {{ $login->is_successful ? '成功' : '失敗' }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- カテゴリー別プロジェクト数 -->
    <div class="bg-white rounded-lg shadow mt-8">
        <div class="p-6 border-b">
            <h2 class="text-xl font-semibold">カテゴリー別プロジェクト数</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($projectsByCategory as $category)
                <div class="bg-gray-50 rounded p-4">
                    <h3 class="font-semibold">{{ $category->category->category_name }}</h3>
                    <p class="text-2xl font-bold">{{ number_format($category->count) }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- 月別支援金額 -->
    <div class="bg-white rounded-lg shadow mt-8">
        <div class="p-6 border-b">
            <h2 class="text-xl font-semibold">月別支援金額</h2>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @foreach($monthlySupports as $monthly)
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-semibold">{{ $monthly->month }}</h3>
                    </div>
                    <div class="text-right">
                        <p class="text-lg font-bold">¥{{ number_format($monthly->total_amount) }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection 