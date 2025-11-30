<?php

namespace App\Http\Controllers;

use App\Models\RewardDetail;
use Illuminate\Http\Request;

class RewardDetailController extends Controller
{
    public function index()
    {
        $rewardDetails = RewardDetail::all();
        return view('reward_details.index', compact('rewardDetails'));
    }

    public function create()
    {
        return view('reward_details.create');
    }

    public function store(Request $request)
    {
        $rewardDetail = new RewardDetail($request->all());
        $rewardDetail->save();
        return redirect()->route('reward_details.index');
    }

    public function show(RewardDetail $rewardDetail)
    {
        return view('reward_details.show', compact('rewardDetail'));
    }

    public function edit(RewardDetail $rewardDetail)
    {
        return view('reward_details.edit', compact('rewardDetail'));
    }

    public function update(Request $request, RewardDetail $rewardDetail)
    {
        $rewardDetail->update($request->all());
        return redirect()->route('reward_details.index');
    }

    public function destroy(RewardDetail $rewardDetail)
    {
        $rewardDetail->delete();
        return redirect()->route('reward_details.index');
    }
}
