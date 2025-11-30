<?php

namespace App\Http\Controllers;

use App\Models\Dreamer;
use Illuminate\Http\Request;

class DreamerController extends Controller
{
    public function index()
    {
        $dreamers = Dreamer::all();
        return view('dreamers.index', compact('dreamers'));
    }

    public function create()
    {
        return view('dreamers.create');
    }

    public function store(Request $request)
    {
        $dreamer = new Dreamer($request->all());
        $dreamer->save();
        return redirect()->route('dreamers.index');
    }

    public function show(Dreamer $dreamer)
    {
        return view('dreamers.show', compact('dreamer'));
    }

    public function edit(Dreamer $dreamer)
    {
        return view('dreamers.edit', compact('dreamer'));
    }

    public function update(Request $request, Dreamer $dreamer)
    {
        $dreamer->update($request->all());
        return redirect()->route('dreamers.index');
    }

    public function destroy(Dreamer $dreamer)
    {
        $dreamer->delete();
        return redirect()->route('dreamers.index');
    }
}
