<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectUpdate;
use Illuminate\Http\Request;

class ProjectUpdateController extends Controller
{
    /**
     * アップデート一覧を表示
     */
    public function index(Project $project)
    {
        $this->authorize('manage', $project);
        $updates = $project->updates()->latest()->paginate(10);
        return view('dashboard.projects.updates', compact('project', 'updates'));
    }

    /**
     * 新規アップデート作成フォームを表示
     */
    public function create(Project $project)
    {
        $this->authorize('manage', $project);
        return view('dashboard.projects.updates.create', compact('project'));
    }

    /**
     * 新規アップデートを保存
     */
    public function store(Request $request, Project $project)
    {
        $this->authorize('manage', $project);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $project->updates()->create($validated);

        return redirect()
            ->route('dashboard.projects.updates.index', $project)
            ->with('success', 'アップデートを投稿しました。');
    }

    /**
     * アップデート編集フォームを表示
     */
    public function edit(Project $project, ProjectUpdate $update)
    {
        $this->authorize('manage', $project);
        return view('dashboard.projects.updates.edit', compact('project', 'update'));
    }

    /**
     * アップデートを更新
     */
    public function update(Request $request, Project $project, ProjectUpdate $update)
    {
        $this->authorize('manage', $project);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $update->update($validated);

        return redirect()
            ->route('dashboard.projects.updates.index', $project)
            ->with('success', 'アップデートを更新しました。');
    }

    /**
     * アップデートを削除
     */
    public function destroy(Project $project, ProjectUpdate $update)
    {
        $this->authorize('manage', $project);
        
        $update->delete();

        return redirect()
            ->route('dashboard.projects.updates.index', $project)
            ->with('success', 'アップデートを削除しました。');
    }
}
