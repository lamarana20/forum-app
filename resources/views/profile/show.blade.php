@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-8">
    <!-- Header Profile -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 dark:from-blue-800 dark:to-purple-800 rounded-xl sm:rounded-2xl shadow-lg p-6 sm:p-8 mb-6 text-white">
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-4 sm:gap-6">
            <!-- Avatar -->
            <div class="w-20 h-20 sm:w-24 sm:h-24 lg:w-32 lg:h-32 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center text-blue-600 dark:text-blue-400 font-bold text-3xl sm:text-4xl lg:text-5xl shadow-xl flex-shrink-0">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            
            <!-- Info -->
            <div class="flex-1 text-center sm:text-left">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold mb-2">{{ $user->name }}</h1>
                <p class="text-blue-100 dark:text-blue-200 mb-3 text-sm sm:text-base break-all">{{ $user->email }}</p>
                
                <!-- Bio -->
                @if($user->bio)
                    <div class="mb-4 p-3 bg-white/10 dark:bg-gray-800/30 rounded-lg backdrop-blur-sm">
                        <p class="text-white text-sm sm:text-base leading-relaxed italic">"{{ $user->bio }}"</p>
                    </div>
                @endif
                
                <!-- Stats -->
                <div class="flex flex-wrap justify-center sm:justify-start gap-4 sm:gap-6 mb-4">
                    <div class="text-center sm:text-left">
                        <div class="text-2xl sm:text-3xl font-bold">{{ $user->threads->count() }}</div>
                        <div class="text-xs sm:text-sm text-blue-100 dark:text-blue-200">Threads</div>
                    </div>
                    <div class="text-center sm:text-left">
                        <div class="text-2xl sm:text-3xl font-bold">{{ $user->posts->count() }}</div>
                        <div class="text-xs sm:text-sm text-blue-100 dark:text-blue-200">Posts</div>
                    </div>
                    <div class="text-center sm:text-left">
                        <div class="text-2xl sm:text-3xl font-bold">{{ $user->created_at->diffForHumans() }}</div>
                        <div class="text-xs sm:text-sm text-blue-100 dark:text-blue-200">Member since</div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="pt-4 border-t border-blue-400/30 dark:border-blue-600/30 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('users.show', $user) }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-white/20 dark:bg-gray-800/30 text-white rounded-lg hover:bg-white/30 dark:hover:bg-gray-800/50 transition backdrop-blur-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        View Public Profile
                    </a>
                    <a href="{{ route('threads.index') }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-white/20 dark:bg-gray-800/30 text-white rounded-lg hover:bg-white/30 dark:hover:bg-gray-800/50 transition backdrop-blur-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        Back to Home
                    </a>
                </div>
            </div>

            <!-- Edit Button -->
            <div class="flex-shrink-0">
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 text-blue-600 dark:text-blue-400 rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Profile
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="bg-white dark:bg-gray-800 rounded-lg sm:rounded-xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
        <div class="px-4 sm:px-6 py-4 bg-gradient-to-r from-gray-50 to-green-50 dark:from-gray-900 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Recent Activity
                </h2>
                <span class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full">
                    Last 5 activities
                </span>
            </div>
        </div>
        
        <div class="p-4 sm:p-6">
            @php
                // Filtrer les posts qui ont un thread
                $threads = $user->threads;
                $posts = $user->posts->filter(function($post) {
                    return $post->thread !== null;
                });
                
                $activities = collect($threads)->merge($posts)->sortByDesc('created_at')->take(5);
            @endphp
            
            @if($activities->count() > 0)
                <div class="space-y-3">
                    @foreach($activities as $activity)
                        @if($activity instanceof App\Models\Thread)
                            {{-- Thread Activity --}}
                            <a href="{{ route('threads.show', $activity) }}" class="flex items-start gap-3 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition group">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                        Created thread • {{ $activity->created_at->diffForHumans() }}
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900 dark:text-white font-medium line-clamp-1 mt-1 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                                        {{ $activity->title }}
                                    </p>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 dark:text-gray-600 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @else
                            {{-- Post Activity --}}
                            <a href="{{ route('threads.show', $activity->thread) }}#post-{{ $activity->id }}" class="flex items-start gap-3 p-3 bg-gray-50 dark:bg-gray-900 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition group">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-400 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                                        Posted reply • {{ $activity->created_at->diffForHumans() }}
                                        in <span class="font-medium text-purple-600 dark:text-purple-400">{{ Str::limit($activity->thread->title, 30) }}</span>
                                    </p>
                                    <p class="text-sm sm:text-base text-gray-900 dark:text-white line-clamp-2 mt-1 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition">
                                        {{ Str::limit($activity->body, 80) }}
                                    </p>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 dark:text-gray-600 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 sm:py-12">
                    <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">No recent activity.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Threads Section -->
    <div class="bg-white dark:bg-gray-800 rounded-lg sm:rounded-xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
        <div class="px-4 sm:px-6 py-4 bg-gradient-to-r from-gray-50 to-blue-50 dark:from-gray-900 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    Threads by {{ $user->name }}
                </h2>
                <span class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full">
                    {{ $user->threads->count() }} {{ $user->threads->count() === 1 ? 'thread' : 'threads' }}
                </span>
            </div>
        </div>
        
        <div class="p-4 sm:p-6">
            @if ($user->threads->count() > 0)
                <div class="space-y-3">
                    @foreach ($user->threads as $thread)
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-3 sm:p-4 bg-gray-50 dark:bg-gray-900 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition group">
                            <a href="{{ route('threads.show', $thread) }}" class="flex-1 min-w-0">
                                <h3 class="font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition text-sm sm:text-base line-clamp-2">
                                    {{ $thread->title }}
                                </h3>
                                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">
                                    {{ $thread->created_at->diffForHumans() }} • {{ $thread->posts->count() }} {{ $thread->posts->count() === 1 ? 'response' : 'responses' }}
                                </p>
                            </a>
                            
                            @auth
                                @can('update', $thread)
                                    <div class="flex gap-2 self-end sm:self-center flex-shrink-0">
                                        <a href="{{ route('threads.edit', $thread) }}" class="px-3 py-1.5 text-xs sm:text-sm bg-purple-600 dark:bg-purple-700 text-white rounded-lg hover:bg-purple-700 dark:hover:bg-purple-600 transition">
                                            Edit
                                        </a>
                                        @can('delete', $thread)
                                            <form action="{{ route('threads.destroy', $thread) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Delete this thread?')" class="px-3 py-1.5 text-xs sm:text-sm bg-red-600 dark:bg-red-700 text-white rounded-lg hover:bg-red-700 dark:hover:bg-red-600 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                @endcan
                            @endauth
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 sm:py-12">
                    <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">No threads created yet.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Posts Section -->
    <div class="bg-white dark:bg-gray-800 rounded-lg sm:rounded-xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="px-4 sm:px-6 py-4 bg-gradient-to-r from-gray-50 to-purple-50 dark:from-gray-900 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    Posts by {{ $user->name }}
                </h2>
                <span class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded-full">
                    {{ $user->posts->count() }} {{ $user->posts->count() === 1 ? 'post' : 'posts' }}
                </span>
            </div>
        </div>
        
        <div class="p-4 sm:p-6">
            @if ($user->posts->count() > 0)
                <div class="space-y-3">
                    @foreach ($user->posts as $post)
                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3 p-3 sm:p-4 bg-gray-50 dark:bg-gray-900 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition group">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm sm:text-base text-gray-700 dark:text-gray-300 line-clamp-2 mb-2">
                                    {{ $post->body }}
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $post->created_at->diffForHumans() }}
                                    @if($post->thread)
                                        • in <a href="{{ route('threads.show', $post->thread) }}#post-{{ $post->id }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ Str::limit($post->thread->title, 30) }}</a>
                                    @endif
                                </p>
                            </div>
                            
                            @auth
                                @can('update', $post)
                                    <div class="flex gap-2 self-end sm:self-start flex-shrink-0">
                                        <a href="{{ route('posts.edit', $post) }}" class="px-3 py-1.5 text-xs sm:text-sm bg-purple-600 dark:bg-purple-700 text-white rounded-lg hover:bg-purple-700 dark:hover:bg-purple-600 transition">
                                            Edit
                                        </a>
                                        @can('delete', $post)
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Delete this post?')" class="px-3 py-1.5 text-xs sm:text-sm bg-red-600 dark:bg-red-700 text-white rounded-lg hover:bg-red-700 dark:hover:bg-red-600 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                @endcan
                            @endauth
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 sm:py-12">
                    <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">No posts yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection