<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Thread;
use App\Models\Post;

class PostController extends Controller
{
    use AuthorizesRequests;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['user', 'thread'])->latest()->paginate(20);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Thread $thread)
    {
        return view('posts.create', compact('thread'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Thread $thread)
    {
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $post = $thread->posts()->create([
            'body' => $validated['body'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('threads.show', $thread)
            ->with('success', 'Your reply has been posted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if ($post->thread) {
            return redirect()->route('threads.show', $post->thread);
        }
        
        abort(404, 'Thread not found');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // Authorize the 'update' action using a Policy
        $this->authorize('update', $post);
        
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Authorize the 'update' action using a Policy
        $this->authorize('update', $post);
        
        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        $post->update($validated);

        return redirect()->route('threads.show', $post->thread)
            ->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Authorize the 'delete' action using a Policy
        $this->authorize('delete', $post);
        
        $thread = $post->thread;
        $post->delete();
        
        return redirect()->route('threads.show', $thread)
            ->with('success', 'Post deleted successfully.');
    }
}