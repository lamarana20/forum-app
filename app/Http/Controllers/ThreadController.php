<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Thread;

class ThreadController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $threads = Thread::with('user')
            ->withCount('posts')
            ->latest()
            ->paginate(15);
            
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:5000',
        ]);

        $thread = auth()->user()->threads()->create($validated);

        return redirect()->route('threads.index', $thread)
            ->with('success', 'Thread created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Thread $thread)
    {
        $thread->load(['posts.user', 'user']);

        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Thread $thread)
    {
        $this->authorize('update', $thread);
        
        return view('threads.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string|max:5000',
        ]);

        $thread->update($validated);

        return redirect()->route('threads.show', $thread)
            ->with('success', 'Thread updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thread $thread)
    {
        $this->authorize('delete', $thread);
        
        $thread->delete();
        
        return redirect()->route('threads.index')
            ->with('success', 'Thread deleted successfully.');
    }
}