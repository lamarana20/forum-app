@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-8">
    <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">{{ $user->name }}'s Posts</h1>

    @forelse ($posts as $post)
        <a href="{{ route('threads.show', $post->thread_id) }}" class="block bg-white dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700 mb-3 hover:border-blue-400 transition">
            <p class="text-gray-700 dark:text-gray-300">{{ Str::limit($post->body, 120) }}</p>
            <p class="text-xs text-gray-400 mt-2">{{ $post->created_at->diffForHumans() }}</p>
        </a>
    @empty
        <p class="text-gray-500 dark:text-gray-400">No posts yet.</p>
    @endforelse

    <div class="mt-6">{{ $posts->links() }}</div>
</div>
@endsection
