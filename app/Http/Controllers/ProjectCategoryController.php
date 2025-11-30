<?php

namespace App\Http\Controllers;

use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    public function index()
    {
        $projectCategories = ProjectCategory::all();
        return view('project_categories.index', compact('projectCategories'));
    }

    public function create()
    {
        return view('project_categories.create');
    }

    public function store(Request $request)
    {
        $projectCategory = new ProjectCategory($request->all());
        $projectCategory->save();
        return redirect()->route('project_categories.index');
    }

    public function show(ProjectCategory $projectCategory)
    {
        return view('project_categories.show', compact('projectCategory'));
    }

    public function edit(ProjectCategory $projectCategory)
    {
        return view('project_categories.edit', compact('projectCategory'));
    }

    public function update(Request $request, ProjectCategory $projectCategory)
    {
        $projectCategory->update($request->all());
        return redirect()->route('project_categories.index');
    }

    public function destroy(ProjectCategory $projectCategory)
    {
        $projectCategory->delete();
        return redirect()->route('project_categories.index');
    }
}
