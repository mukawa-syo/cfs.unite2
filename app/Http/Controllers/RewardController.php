<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::all();
        return view('rewards.index', compact('rewards'));
    }

    public function create()
    {
        return view('rewards.create');
    }

    public function store(Request $request)
    {
        $reward = new Reward($request->all());
        $reward->save();
        return redirect()->route('rewards.index');
    }

    public function show(Reward $reward)
    {
        return view('rewards.show', compact('reward'));
    }

    public function edit(Reward $reward)
    {
        return view('rewards.edit', compact('reward'));
    }

    public function update(Request $request, Reward $reward)
    {
        $reward->update($request->all());
        return redirect()->route('rewards.index');
    }

    public function destroy(Reward $reward)
    {
        $reward->delete();
        return redirect()->route('rewards.index');
    }
}
