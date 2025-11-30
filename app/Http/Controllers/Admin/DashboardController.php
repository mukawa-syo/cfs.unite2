<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Support;
use App\Models\Order;
use App\Models\LoginHistory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,moderator']);
    }

    /**
     * 管理者ダッシュボードの表示
     */
    public function index()
    {
        // 基本統計情報
        $stats = [
            'total_users' => User::count(),
            'total_projects' => Project::count(),
            'total_supports' => Support::count(),
            'total_orders' => Order::count(),
            'total_amount' => Order::sum('amount'),
        ];

        // 最近のプロジェクト
        $recentProjects = Project::with(['category', 'user'])
            ->latest()
            ->take(5)
            ->get();

        // 最近の支援
        $recentSupports = Support::with(['user', 'project', 'reward'])
            ->latest()
            ->take(5)
            ->get();

        // 最近の注文
        $recentOrders = Order::with(['user'])
            ->latest()
            ->take(5)
            ->get();

        // 最近のログイン履歴
        $recentLogins = LoginHistory::with(['user'])
            ->latest()
            ->take(5)
            ->get();

        // カテゴリー別プロジェクト数
        $projectsByCategory = Project::select('project_category_id', DB::raw('count(*) as count'))
            ->groupBy('project_category_id')
            ->with('category')
            ->get();

        // 月別支援金額
        $monthlySupports = Support::select(
                DB::raw('DATE_FORMAT(supported_at, "%Y-%m") as month'),
                DB::raw('SUM(amount) as total_amount')
            )
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->take(12)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentProjects',
            'recentSupports',
            'recentOrders',
            'recentLogins',
            'projectsByCategory',
            'monthlySupports'
        ));
    }

    /**
     * ユーザー管理画面の表示
     */
    public function users()
    {
        $users = User::withCount(['projects', 'supports'])
            ->latest()
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * プロジェクト管理画面の表示
     */
    public function projects()
    {
        $projects = Project::with(['category', 'user'])
            ->withCount('supports')
            ->latest()
            ->paginate(20);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * 支援管理画面の表示
     */
    public function supports()
    {
        $supports = Support::with(['user', 'project', 'reward'])
            ->latest()
            ->paginate(20);

        return view('admin.supports.index', compact('supports'));
    }

    /**
     * 注文管理画面の表示
     */
    public function orders()
    {
        $orders = Order::with(['user', 'project', 'reward'])
            ->latest()
            ->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * ログイン履歴の表示
     */
    public function loginHistory()
    {
        $logins = LoginHistory::with(['user'])
            ->latest()
            ->paginate(20);

        return view('admin.logins.index', compact('logins'));
    }
}
