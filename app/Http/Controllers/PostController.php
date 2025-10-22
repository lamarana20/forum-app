<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thread;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Thread $thread)
    {
        // Valider les données du formulaire
        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        // Créer un nouveau post associé au fil de discussion
        $post = new Post();
        $post->body = $request->body;
        $post->user_id = auth()->id(); // ou tout autre logique pour récupérer l'ID de l'utilisateur connecté
        $post->thread_id = $thread->id;
        $post->save();

        return redirect()->route('threads.show', $thread)
            ->with('success', 'Post created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::find($id);    
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            
            'body' => 'required',

        ]);

        $post->update($request->all());

        return redirect()->route('threads.index', $post->thread);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $thread = $post->thread;
        $post->delete();
        return redirect()->route('threads.show', $thread);
    }
}
