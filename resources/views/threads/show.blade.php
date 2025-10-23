@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-8">
    <!-- Thread Principal -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
        <!-- Header avec actions -->
        <div class="p-4 sm:p-6 lg:p-8">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-4">
                <div class="flex-1">
                    <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-3 break-words">
                        {{ $thread->title }}
                    </h1>
                    
                    <!-- Auteur et date -->
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                            {{ strtoupper(substr($thread->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900 dark:text-white text-sm sm:text-base">
                                <a href="{{ route('users.show', $thread->user) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">
                                    {{ $thread->user->name ?? 'Utilisateur inconnu' }}
                                </a>
                            </p>
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">
                                {{ $thread->created_at->format('d M Y') }} • {{ $thread->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                @auth
                    @can('update', $thread)
                        <div class="flex gap-2 sm:flex-col sm:gap-2">
                            <a href="{{ route('threads.edit', $thread) }}" class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-purple-600 dark:bg-purple-700 text-white text-sm font-semibold rounded-lg hover:bg-purple-700 dark:hover:bg-purple-600 transition active:scale-95">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            @can('delete', $thread)
                                <form action="{{ route('threads.destroy', $thread) }}" method="POST" class="flex-1 sm:flex-none">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this thread?')" class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 dark:bg-red-700 text-white text-sm font-semibold rounded-lg hover:bg-red-700 dark:hover:bg-red-600 transition active:scale-95">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            @endcan
                        </div>
                    @endcan
                @endauth
            </div>

            <!-- Corps du thread -->
            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                <p class="text-base sm:text-lg text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap break-words">
                    {{ $thread->body }}
                </p>
            </div>
        </div>

        <!-- Stats avec compteur de réponses -->
        <div class="px-4 sm:px-6 lg:px-8 py-4 bg-gray-50 dark:bg-gray-900 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center text-sm sm:text-base text-gray-600 dark:text-gray-400">
                    <svg class="w-5 h-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $thread->posts->count() }}</span>
                    <span class="ml-1">{{ $thread->posts->count() === 1 ? 'response' : 'responses' }}</span>
                </div>

                <!-- Bouton retour -->
                <a href="{{ route('threads.index') }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition group">
                    <svg class="w-4 h-4 mr-1 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to threads
                </a>
            </div>
        </div>
    </div>

    <!-- Section Discussions -->
    <div class="mb-6">
        <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
            <svg class="w-6 h-6 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
            </svg>
            Discussions
            @if($thread->posts->count() > 0)
                <span class="ml-2 px-3 py-1 bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 text-white rounded-full text-sm font-bold shadow-md">
                    {{ $thread->posts->count() }}
                </span>
            @endif
        </h2>

        @if ($thread->posts->count() > 0)
            <div class="space-y-3 sm:space-y-4">
                @foreach($thread->posts as $post)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="p-4 sm:p-6">
                            <!-- En-tête du post -->
                            <div class="flex items-start justify-between gap-3 mb-3">
                                <div class="flex items-center space-x-2 sm:space-x-3 flex-1 min-w-0">
                                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-green-500 to-teal-600 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                        {{ strtoupper(substr($post->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="font-semibold text-sm sm:text-base text-gray-900 dark:text-white truncate">
                                            <a href="{{ route('users.show', $post->user) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">
                                                {{ $post->user->name ?? 'Utilisateur inconnu' }}
                                            </a>
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $post->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Actions du post -->
                                @auth
                                    <div class="flex gap-2 flex-shrink-0">
                                        @can('update', $post)
                                            <a href="{{ route('posts.edit', $post) }}" class="p-2 text-purple-600 dark:text-purple-400 hover:bg-purple-50 dark:hover:bg-purple-900/20 rounded-lg transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                        @endcan
                                        @can('delete', $post)
                                            <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Delete this response?')" class="p-2 text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                @endauth
                            </div>

                            <!-- Corps du post -->
                            <div class="text-sm sm:text-base text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap break-words">
                                {{ $post->body }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-gray-50 dark:bg-gray-800 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center">
                <svg class="w-12 h-12 sm:w-16 sm:h-16 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <p class="text-gray-600 dark:text-gray-400 text-sm sm:text-base">No responses yet. Be the first to reply!</p>
            </div>
        @endif
    </div>

    <!-- Formulaire de réponse -->
    @auth
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-4 sm:px-6 py-4 bg-gradient-to-r from-blue-50 to-purple-50 dark:from-gray-900 dark:to-gray-800 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white flex items-center">
                    <svg class="w-5 h-5 sm:w-6 sm:h-6 mr-2 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add your response
                </h3>
            </div>
            
            <form action="{{ route('posts.store', $thread) }}" method="POST" class="p-4 sm:p-6">
                @csrf
                <div class="group">
                    <label for="body" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Your answer
                    </label>
                    <textarea 
                        name="body" 
                        id="body" 
                        rows="4"
                        class="w-full px-4 py-3 text-sm sm:text-base border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 transition-all duration-200 hover:border-gray-300 dark:hover:border-gray-500 resize-none @error('body') border-red-400 ring-2 ring-red-100 dark:ring-red-900 @enderror"
                        placeholder="Share your thoughts..."
                        required>{{ old('body') }}</textarea>
                    @error('body')
                        <p class="text-red-500 dark:text-red-400 text-xs sm:text-sm mt-2 flex items-start">
                            <svg class="w-4 h-4 mr-1 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>
                
                <div class="mt-4 flex gap-3">
                    <button 
                        type="submit"
                        class="flex-1 sm:flex-none bg-gradient-to-r from-blue-600 to-blue-700 dark:from-blue-700 dark:to-blue-800 text-white font-bold px-6 py-3 text-sm sm:text-base rounded-lg hover:from-blue-700 hover:to-blue-800 dark:hover:from-blue-600 dark:hover:to-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800 active:scale-95 transition-all shadow-lg hover:shadow-xl inline-flex items-center justify-center">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Post Reply
                    </button>
                </div>
            </form>
        </div>
    @else
        <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500 dark:border-blue-400 p-4 rounded-r-lg">
            <p class="text-blue-700 dark:text-blue-300 text-sm sm:text-base flex items-start">
                <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Please <a href="{{ route('login') }}" class="font-semibold underline hover:text-blue-800 dark:hover:text-blue-200">login</a> to post a reply.</span>
            </p>
        </div>
    @endauth
</div>
@endsection