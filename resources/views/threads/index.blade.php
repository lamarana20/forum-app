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

    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-6 sm:mb-8">
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white">Threads</h1>
        
        @auth
            <a href="{{ route('threads.create') }}" class="bg-blue-600 dark:bg-blue-700 text-white px-4 sm:px-6 py-2.5 sm:py-3 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition-all duration-300 font-semibold shadow-md hover:shadow-lg active:scale-95 inline-flex items-center justify-center space-x-2 text-sm sm:text-base w-full sm:w-auto">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Create a new thread</span>
            </a>
        @endauth
    </div>

    <div class="space-y-3 sm:space-y-4">
        @foreach($threads as $thread)
            <div class="bg-white dark:bg-gray-800 rounded-lg sm:rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 dark:border-gray-700 hover:border-blue-200 dark:hover:border-blue-700">
                <div class="p-4 sm:p-6">
                    <!-- Header with author and date -->
                    <div class="flex items-center space-x-2 sm:space-x-3 mb-3 sm:mb-4">
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
                                    {{ $thread->user->name }}
                                @else
                                    Unknown author
                                @endif
                            </p>
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400">{{ $thread->created_at->diffForHumans() }}</p>
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
                        <a href="{{ route('threads.show', $thread) }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium flex items-center space-x-1 transition-colors text-sm sm:text-base">
                            <span>View discussion</span>
                            <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection