<?php

namespace App\Http\Controllers;

use App\Models\Supporter;
use Illuminate\Http\Request;

class SupporterController extends Controller
{
    public function index()
    {
        $supporters = Supporter::all();
        return view('supporters.index', compact('supporters'));
    }

    public function create()
    {
        return view('supporters.create');
    }

    public function store(Request $request)
    {
        $supporter = new Supporter($request->all());
        $supporter->save();
        return redirect()->route('supporters.index');
    }

    public function show(Supporter $supporter)
    {
        return view('supporters.show', compact('supporter'));
    }

    public function edit(Supporter $supporter)
    {
        return view('supporters.edit', compact('supporter'));
    }

    public function update(Request $request, Supporter $supporter)
    {
        $supporter->update($request->all());
        return redirect()->route('supporters.index');
    }

    public function destroy(Supporter $supporter)
    {
        $supporter->delete();
        return redirect()->route('supporters.index');
    }
}
