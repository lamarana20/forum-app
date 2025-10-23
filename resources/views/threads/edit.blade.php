@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center py-6 sm:py-12 px-3 sm:px-6 lg:px-8 bg-gradient-to-br from-purple-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-950 dark:to-gray-900">
    <div class="max-w-3xl w-full">
        <!-- Header -->
        <div class="text-center mb-6 sm:mb-8">
            <div class="inline-block p-2 sm:p-3 bg-purple-100 dark:bg-purple-900 rounded-full mb-3 sm:mb-4">
                <svg class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-2">Edit Thread</h2>   
            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 px-4">Update your thread information</p>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl sm:rounded-3xl overflow-hidden border border-gray-200 dark:border-gray-700 backdrop-blur-sm bg-opacity-95">
            <div class="px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-10">
                <form action="{{ route('threads.update', $thread) }}" method="POST" class="space-y-5 sm:space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Title -->
                    <div class="group">
                        <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 group-focus-within:text-purple-600 dark:group-focus-within:text-purple-400 transition-colors">
                            Title
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 sm:pl-4 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400 dark:text-gray-500 group-focus-within:text-purple-500 dark:group-focus-within:text-purple-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                value="{{ old('title', $thread->title) }}"
                                class="w-full pl-10 sm:pl-12 pr-3 sm:pr-4 py-3 sm:py-3.5 text-sm sm:text-base border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg sm:rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-purple-500 dark:focus:border-purple-400 transition-all duration-200 hover:border-gray-300 dark:hover:border-gray-500 @error('title') border-red-400 ring-2 ring-red-100 dark:ring-red-900 @enderror"
                                placeholder="Enter thread title..."
                                required>
                        </div>
                        @error('title')
                            <p class="text-red-500 dark:text-red-400 text-xs sm:text-sm mt-2 flex items-start">
                                <svg class="w-4 h-4 mr-1 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Body -->
                    <div class="group">
                        <label for="body" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2 group-focus-within:text-purple-600 dark:group-focus-within:text-purple-400 transition-colors">
                            Content
                        </label>
                        <div class="relative">
                            <div class="absolute top-3 sm:top-4 left-3 sm:left-4 pointer-events-none">
                                <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400 dark:text-gray-500 group-focus-within:text-purple-500 dark:group-focus-within:text-purple-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </div>
                            <textarea 
                                name="body" 
                                id="body" 
                                rows="6"
                                class="w-full pl-10 sm:pl-12 pr-3 sm:pr-4 py-3 sm:py-3.5 text-sm sm:text-base border-2 border-gray-200 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg sm:rounded-xl focus:outline-none focus:ring-2 focus:ring-purple-500 dark:focus:ring-purple-400 focus:border-purple-500 dark:focus:border-purple-400 transition-all duration-200 hover:border-gray-300 dark:hover:border-gray-500 resize-none @error('body') border-red-400 ring-2 ring-red-100 dark:ring-red-900 @enderror"
                                placeholder="Update your content..."
                                required>{{ old('body', $thread->body) }}</textarea>
                        </div>
                        @error('body')
                            <p class="text-red-500 dark:text-red-400 text-xs sm:text-sm mt-2 flex items-start">
                                <svg class="w-4 h-4 mr-1 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <span>{{ $message }}</span>
                            </p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 pt-2 sm:pt-3">
                        <button 
                            type="submit"
                            class="flex-1 relative bg-gradient-to-r from-purple-600 to-purple-700 dark:from-purple-700 dark:to-purple-800 text-white font-bold px-5 sm:px-6 py-3 sm:py-4 text-sm sm:text-base rounded-lg sm:rounded-xl hover:from-purple-700 hover:to-purple-800 dark:hover:from-purple-600 dark:hover:to-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-300 dark:focus:ring-purple-800 active:scale-95 transition-all duration-200 shadow-lg hover:shadow-2xl group overflow-hidden order-1">
                            <span class="relative z-10 flex items-center justify-center">
                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update Thread
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-700 to-purple-800 dark:from-purple-600 dark:to-purple-700 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                        </button>

                        <a 
                            href="{{ route('threads.show', $thread) }}"
                            class="sm:order-2 order-2 px-5 sm:px-6 py-3 sm:py-4 text-sm sm:text-base bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg sm:rounded-xl hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-200 text-center active:scale-95">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>

            <!-- Footer Info -->
            <div class="px-4 sm:px-6 lg:px-8 py-4 sm:py-5 bg-gradient-to-r from-gray-50 to-purple-50 dark:from-gray-800 dark:to-gray-900 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-start space-x-2">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 text-purple-600 dark:text-purple-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">
                        <strong>Note:</strong> Your changes will be saved immediately and visible to all users.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection