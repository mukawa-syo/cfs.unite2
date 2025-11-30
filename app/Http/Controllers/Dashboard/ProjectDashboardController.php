<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectDashboardController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())
            // ->withCount('supporters')
            ->get();

        return view('dashboard.projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
        $this->authorize('manage', $project);

        // $project->loadCount('supporters');
        $recentUpdates = $project->updates()->latest()->take(5)->get();
        $recentSupporters = $project->supporters()->latest()->take(5)->get();

        return view('dashboard.projects.show', compact('project', 'recentUpdates', 'recentSupporters'));
    }

    public function updates(Project $project)
    {
        $this->authorize('manage', $project);

        $updates = $project->updates()->latest()->paginate(10);
        return view('dashboard.projects.updates', compact('project', 'updates'));
    }

    public function storeUpdate(Request $request, Project $project)
    {
        $this->authorize('manage', $project);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $project->updates()->create([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('dashboard.projects.updates', $project)
            ->with('success', 'アップデートを投稿しました。');
    }

    public function supporters(Project $project)
    {
        $this->authorize('manage', $project);

        $supporters = $project->supporters()->latest()->paginate(20);
        return view('dashboard.projects.supporters', compact('project', 'supporters'));
    }

    public function updateUpdate(Request $request, Project $project, ProjectUpdate $update)
    {
        $this->authorize('manage', $project);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $update->update($validated);

        return redirect()->route('dashboard.projects.updates', $project)
            ->with('success', 'アップデートを更新しました。');
    }

    public function destroyUpdate(Project $project, ProjectUpdate $update)
    {
        $this->authorize('manage', $project);

        $update->delete();

        return redirect()->route('dashboard.projects.updates', $project)
            ->with('success', 'アップデートを削除しました。');
    }
}
