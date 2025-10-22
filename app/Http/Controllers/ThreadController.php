<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $threads = Thread::with('user')->get();
        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('threads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $thread = new Thread($request->all());
        $thread->user_id = auth()->id();
        $thread->save();

        return redirect()->route('threads.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Thread $thread)
    {
        $thread->load('posts');
     

        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thread $thread)
    {
        return view('threads.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Thread $thread)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $thread->update($request->all());

        return redirect()->route('threads.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thread $thread)
    {
        $thread->delete();
        return redirect()->route('threads.index');
    }
}
