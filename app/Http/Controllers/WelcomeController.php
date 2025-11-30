<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::where('is_featured', true)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $latestProjects = Project::active()
            ->where('is_featured', false)
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $newProjects = Project::active()
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $categories = ProjectCategory::withCount(['projects' => function ($query) {
            $query->where('deadline', '>=', now()->toDateString());
        }])->get();

        return view('welcome', compact('featuredProjects', 'latestProjects', 'categories', 'newProjects'));
    }
} 