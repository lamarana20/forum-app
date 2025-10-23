@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-3 sm:px-4 py-4 sm:py-6">
    <!-- Header Profile Simple -->
    <div class="text-center mb-8">
        <!-- Avatar -->
        <div class="w-24 h-24 sm:w-32 sm:h-32 mx-auto mb-4 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-3xl sm:text-4xl shadow-lg">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>
        
        <!-- Name -->
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $user->name }}</h1>
        
        <!-- Stats -->
        <div class="flex justify-center gap-6 mb-4 text-gray-600 dark:text-gray-400">
            <div class="text-center">
                <div class="font-semibold text-gray-900 dark:text-white">{{ $user->threads->count() }}</div>
                <div class="text-sm">Threads</div>
            </div>
            <div class="text-center">
                <div class="font-semibold text-gray-900 dark:text-white">{{ $user->posts->count() }}</div>
                <div class="text-sm">Posts</div>
            </div>
            <div class="text-center">
                <div class="font-semibold text-gray-900 dark:text-white">{{ $user->created_at->format('M Y') }}</div>
                <div class="text-sm">Joined</div>
            </div>
        </div>

        <!-- Bio (si disponible) -->
        @if($user->bio)
            <p class="text-gray-600 dark:text-gray-300 text-sm sm:text-base max-w-md mx-auto mb-4">
                {{ $user->bio }}
            </p>
        @endif
    </div>

    <!-- Posts Section - Style TikTok/Facebook -->
    <div class="space-y-4">
        @if($user->posts->count() > 0)
            @foreach($user->posts as $post)
                <div class="bg-white dark:bg-gray-800 rounded-lg sm:rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-4 sm:p-6 hover:shadow-md transition-shadow">
                    <!-- Post Header -->
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900 dark:text-white text-sm">{{ $user->name }}</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <!-- Post Content -->
                    <div class="mb-3">
                        <p class="text-gray-800 dark:text-gray-200 text-sm sm:text-base leading-relaxed">
                            {{ $post->body }}
                        </p>
                    </div>

                    <!-- Thread Info -->
                    @if($post->thread)
                        <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 mb-3">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                            </svg>
                            <span>In: </span>
                            <a href="{{ route('threads.show', $post->thread) }}" class="text-blue-600 dark:text-blue-400 hover:underline font-medium">
                                {{ Str::limit($post->thread->title, 40) }}
                            </a>
                        </div>
                    @endif

                    <!-- Actions -->
                    <div class="flex items-center justify-between pt-3 border-t border-gray-100 dark:border-gray-700">
                        <div class="flex items-center gap-4">
                            <!-- Like Button -->
                            <button class="flex items-center gap-1 text-gray-500 dark:text-gray-400 hover:text-red-500 dark:hover:text-red-400 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <span class="text-sm">Like</span>
                            </button>

                            <!-- Comment Button -->
                            <a href="{{ route('threads.show', $post->thread) }}#post-{{ $post->id }}" class="flex items-center gap-1 text-gray-500 dark:text-gray-400 hover:text-blue-500 dark:hover:text-blue-400 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                <span class="text-sm">Reply</span>
                            </a>
                        </div>

                        <!-- Share Button -->
                        <button class="flex items-center gap-1 text-gray-500 dark:text-gray-400 hover:text-green-500 dark:hover:text-green-400 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                            </svg>
                            <span class="text-sm">Share</span>
                        </button>
                    </div>
                </div>
            @endforeach
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No posts yet</h3>
                <p class="text-gray-600 dark:text-gray-400 text-sm">When {{ $user->name }} posts something, it will appear here.</p>
            </div>
        @endif
    </div>

    <!-- Load More Button (optionnel) -->
    @if($user->posts->count() > 5)
        <div class="text-center mt-8">
            <button class="px-6 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition font-medium">
                Load More Posts
            </button>
        </div>
    @endif
</div>
@endsection