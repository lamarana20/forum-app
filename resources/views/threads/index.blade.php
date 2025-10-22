@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        @guest
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded-r-lg">
                <p class="text-blue-700">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    If you are logged in, you will see the thread creation button.
                </p>
            </div>
        @endguest

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Threads</h1>
            
            @auth
                <a href="{{ route('threads.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-all duration-300 font-semibold shadow-md hover:shadow-lg transform hover:-translate-y-0.5 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Create a new thread</span>
                </a>
            @endauth
        </div>

        <div class="space-y-4">
            @foreach($threads as $thread)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-blue-200">
                    <div class="p-6">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                                @if ($thread->user)
                                    {{ strtoupper(substr($thread->user->name, 0, 1)) }}
                                @else
                                    ?
                                @endif
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">
                                    @if ($thread->user)
                                        {{ $thread->user->name }}
                                    @else
                                        Unknown author
                                    @endif
                                </p>
                                <p class="text-sm text-gray-500">{{ $thread->created_at->diffForHumans() }}</p>
                            </div>
                        </div>

                        <a href="{{ route('threads.show', $thread) }}" class="block group">
                            <h2 class="text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-300 mb-3">
                                {{ $thread->title }}
                            </h2>
                        </a>

                        <a href="{{ route('threads.show', $thread) }}" class="block">
                            <p class="text-gray-700 leading-relaxed line-clamp-3 hover:text-gray-900 transition-colors">
                                {{ $thread->body }}
                            </p>
                        </a>

                        <div class="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between">
                            <a href="{{ route('threads.show', $thread) }}" class="text-blue-600 hover:text-blue-700 font-medium flex items-center space-x-1 transition-colors">
                                <span>View discussion</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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