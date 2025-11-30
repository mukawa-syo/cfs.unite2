<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Reward;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->only(["index","create","store","edit","update","destroy"]);
    }

    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Project::with(["category"])
            ->where("deadline", ">=", now()->toDateString());

        if ($request->filled("category")) {
            $query->where("project_category_id", $request->input("category"));
        }

        $filter = $request->input("filter", "all");
        if ($filter === "new") {
            $query->where("created_at", ">=", now()->subDays(7));
        } elseif ($filter === "featured") {
            $query->where("is_featured", true);
        }

        $projects = $query->orderBy("deadline","asc")
            ->orderBy("created_at","desc")
            ->paginate(10);

        return view("projects.index", compact("projects","categories"));
    }

    public function create()
    {
        // Check if user has permission to create projects
        if (!Auth::user()->can_create_projects) {
            return redirect()->route('project-creation-requests.create')
                ->with('warning', 'プロジェクトを作成するには、まず承認を受ける必要があります。');
        }

        $categories = Category::all();
        return view("projects.create", compact("categories"));
    }

    public function show(Project $project)
    {
        $project->load(['category', 'rewards', 'user']);
        return view('projects.show', compact('project'));
    }

    public function store(Request $request)
    {
        // Check if user has permission to create projects
        if (!Auth::user()->can_create_projects) {
            abort(403, 'プロジェクトを作成する権限がありません。');
        }

        // 画面の項目名 → DBカラムへマッピング（※画像カラムはDBに無いので保存のみ）
        $request->validate([
            "project_name"                => "required|string|max:255",
            "project_description"         => "required|string|min:10",
            "project_image"               => "nullable|image|mimes:jpeg,png,jpg,gif|max:5120",
            "target_amount"               => "required|numeric|min:1000|max:100000000",
            "deadline"                    => "required|date|after:today",
            "project_category_id"         => "required|integer",
            "rewards"                     => "required|array|min:1|max:10",
            "rewards.*.reward_name"       => "required|string|max:255",
            "rewards.*.price_incl_tax"    => "required|numeric|min:1|max:1000000",
            "rewards.*.reward_description"=> "required|string|min:10|max:1000",
            "rewards.*.reward_image"      => "nullable|image|mimes:jpeg,png,jpg,gif|max:5120",
            "rewards.*.delivery_schedule" => "required|date|after:deadline",
        ]);

        \Log::info("Project creation started", ["request" => $request->except(["project_image","rewards.*.reward_image"])]);

        // 画像はストレージ保存とDB保存
        $projectImagePath = null;
        if ($request->hasFile("project_image")) {
            $file = $request->file("project_image");
            $filename = time()."_".uniqid().".". $file->getClientOriginalExtension();
            $projectImagePath = $file->storeAs("project-images", $filename, "public");
            \Log::info("Project image saved", ["path" => $projectImagePath]);
        }

        try {
            DB::beginTransaction();

            $project = Project::create([
                "title"                => $request->project_name,
                "description"          => $request->project_description,
                "project_image"        => $projectImagePath,
                "goal_amount"          => $request->target_amount,
                "deadline"             => $request->deadline,
                "project_category_id"  => $request->project_category_id,
                "user_id"              => Auth::id(),
                "status"               => "open",
                // is_featured は既定 false（必要ならリクエストから立てる）
            ]);

            foreach ($request->rewards as $rewardData) {
                $reward = new Reward([
                    "reward_name"        => $rewardData["reward_name"],
                    "price_incl_tax"     => $rewardData["price_incl_tax"],
                    "reward_description" => $rewardData["reward_description"],
                    "delivery_schedule"  => $rewardData["delivery_schedule"],
                    // reward_image はストレージ保存のみ（DBにあればここで設定）
                ]);
                $project->rewards()->save($reward);
            }

            DB::commit();
            \Log::info("Project creation completed successfully", ["project_id" => $project->id]);

            return redirect()->route("projects.index")->with("success","プロジェクトが正常に作成されました。");
        } catch (\Throwable $e) {
            DB::rollBack();
            \Log::error("Project creation failed", ["error" => $e->getMessage(), "trace" => $e->getTraceAsString()]);
            return back()->withInput()->with("error","プロジェクトの作成に失敗しました。もう一度お試しください。");
        }
    }
}
