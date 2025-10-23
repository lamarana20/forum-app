@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-8">
    @guest
        <div class="bg-blue-50 dark:bg-blue-900/20 border-l-4 border-blue-500 dark:border-blue-400 p-3 sm:p-4 mb-4 sm:mb-6 rounded-r-lg">
            <p class="text-sm sm:text-base text-blue-700 dark:text-blue-300 flex items-start">
                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Hey there! Log in to join the conversation and create your own thread.</span>
            </p>
        </div>
    @endguest

    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">
        <div>
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-1">Threads</h1>
            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">
                {{ $threads->total() }} {{ $threads->total() === 1 ? 'thread' : 'threads' }} • Page {{ $threads->currentPage() }} of {{ $threads->lastPage() }}
            </p>
        </div>
        
        @auth
            <a href="{{ route('threads.create') }}" class="bg-blue-600 dark:bg-blue-700 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition-all duration-300 font-semibold shadow-md hover:shadow-lg active:scale-95 inline-flex items-center justify-center space-x-2 text-sm sm:text-base w-full sm:w-auto">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Create a new thread</span>
            </a>
        @endauth
    </div>

    <!-- Threads List -->
    @if($threads->count() > 0)
        <div class="space-y-3 sm:space-y-4">
            @foreach($threads as $thread)
                <div class="bg-white dark:bg-gray-800 rounded-lg sm:rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700 hover:border-blue-200 dark:hover:border-blue-700">
                    <div class="p-4 sm:p-6">
                        <!-- Header with author and date -->
                        <div class="flex items-center justify-between mb-3 sm:mb-4">
                            <div class="flex items-center space-x-2 sm:space-x-3 min-w-0 flex-1">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                                    @if ($thread->user)
                                        {{ strtoupper(substr($thread->user->name, 0, 1)) }}
                                    @else
                                        ?
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="font-semibold text-sm sm:text-base text-gray-900 dark:text-white truncate">
                                        @if ($thread->user)
                                            <a href="{{ route('users.show', $thread->user) }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">
                                                {{ $thread->user->name }}
                                            </a>
                                        @else
                                            Unknown author
                                        @endif
                                    </p>
                                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">{{ $thread->created_at->diffForHumans() }}</p>
                                </div>
                            </div>

                            <!-- Response count badge -->
                            <div class="flex items-center space-x-1 bg-blue-50 dark:bg-blue-900/20 px-2 sm:px-3 py-1 rounded-full flex-shrink-0">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                </svg>
                                <span class="text-xs sm:text-sm font-semibold text-blue-600 dark:text-blue-400">
                                    {{ $thread->posts_count }}
                                </span>
                            </div>
                        </div>

                        <!-- Thread title -->
                        <a href="{{ route('threads.show', $thread) }}" class="block group">
                            <h2 class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300 mb-2 sm:mb-3 line-clamp-2">
                                {{ $thread->title }}
                            </h2>
                        </a>

                        <!-- Thread body -->
                        <a href="{{ route('threads.show', $thread) }}" class="block">
                            <p class="text-sm sm:text-base text-gray-700 dark:text-gray-300 leading-relaxed line-clamp-2 sm:line-clamp-3 hover:text-gray-900 dark:hover:text-gray-100 transition-colors">
                                {{ $thread->body }}
                            </p>
                        </a>

                        <!-- Footer with actions -->
                        <div class="mt-3 sm:mt-4 pt-3 sm:pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                            <a href="{{ route('threads.show', $thread) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium flex items-center space-x-1 transition-colors text-sm sm:text-base group">
                                <span>View discussion</span>
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>

                            <!-- Edit/Delete buttons for thread owner -->
                            @auth
                                @can('update', $thread)
                                    <div class="flex gap-2">
                                        <a href="{{ route('threads.edit', $thread) }}" class="px-2 sm:px-3 py-1 sm:py-1.5 text-xs sm:text-sm bg-purple-600 dark:bg-purple-700 text-white rounded-lg hover:bg-purple-700 dark:hover:bg-purple-600 transition">
                                            Edit
                                        </a>
                                        @can('delete', $thread)
                                            <form action="{{ route('threads.destroy', $thread) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Delete this thread and all its responses?')" class="px-2 sm:px-3 py-1 sm:py-1.5 text-xs sm:text-sm bg-red-600 dark:bg-red-700 text-white rounded-lg hover:bg-red-700 dark:hover:bg-red-600 transition">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                @endcan
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6 sm:mt-8">
            {{ $threads->links() }}
        </div>
    @else
        <!-- Empty state -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 p-8 sm:p-12 text-center">
            <svg class="w-16 h-16 sm:w-20 sm:h-20 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
            </svg>
            <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-white mb-2">No threads yet</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Be the first to start a conversation!</p>
            @auth
                <a href="{{ route('threads.create') }}" class="inline-flex items-center space-x-2 bg-blue-600 dark:bg-blue-700 text-white px-6 py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Create the first thread</span>
                </a>
            @endauth
        </div>
    @endif
</div>

<!-- Custom Pagination Styling -->
<style>
    .pagination {
        @apply flex justify-center space-x-1 sm:space-x-2;
    }
    .pagination a,
    .pagination span {
        @apply px-2 sm:px-3 py-1 sm:py-2 text-xs sm:text-sm rounded-lg border transition-colors;
    }
    .pagination a {
        @apply border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-blue-900/20 hover:border-blue-300 dark:hover:border-blue-700;
    }
    .pagination .active span {
        @apply bg-blue-600 dark:bg-blue-700 text-white border-blue-600 dark:border-blue-700;
    }
    .pagination .disabled span {
        @apply border-gray-200 dark:border-gray-700 text-gray-400 dark:text-gray-600 cursor-not-allowed;
    }
</style>
@endsection