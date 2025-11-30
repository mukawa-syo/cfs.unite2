<?php

namespace App\Http\Controllers;

use App\Models\ProjectKind;
use Illuminate\Http\Request;

class ProjectKindController extends Controller
{
    public function index()
    {
        $projectKinds = ProjectKind::all();
        return view('project_kinds.index', compact('projectKinds'));
    }

    public function create()
    {
        return view('project_kinds.create');
    }

    public function store(Request $request)
    {
        $projectKind = new ProjectKind($request->all());
        $projectKind->save();
        return redirect()->route('project_kinds.index');
    }

    public function show(ProjectKind $projectKind)
    {
        return view('project_kinds.show', compact('projectKind'));
    }

    public function edit(ProjectKind $projectKind)
    {
        return view('project_kinds.edit', compact('projectKind'));
    }

    public function update(Request $request, ProjectKind $projectKind)
    {
        $projectKind->update($request->all());
        return redirect()->route('project_kinds.index');
    }

    public function destroy(ProjectKind $projectKind)
    {
        $projectKind->delete();
        return redirect()->route('project_kinds.index');
    }
}
