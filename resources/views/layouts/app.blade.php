<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MLD Forum') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon-1.png') }}">
    @vite('resources/css/app.css')
</head>
<body>

    <!-- Navbar -->
    <nav class="bg-white text-gray-800 shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ url('threads') }}" class="text-xl font-bold hover:text-blue-600 transition">
                {{ config('app.name', 'Forum') }}
            </a>

            <!-- User Menu -->
            <div class="flex items-center space-x-4">
                @auth
                    <div class="relative">
                        <button id="user-button" class="flex items-center space-x-2 text-gray-700 hover:text-blue-600 transition font-medium">
                            <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden md:block">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div id="user-dropdown" class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg py-2 hidden">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition">
                                My Profile
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 hover:text-white transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition">Login</a>
                    @if(Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl mx-auto py-6 px-4">
        @yield('content')
    </main>

    <!-- Footer -->
   @include('layouts.footer')

    <!-- JS Dropdown -->
    <script>
 
const button = document.getElementById('user-button');


const dropdown = document.getElementById('user-dropdown');

// Show the dropdown when the mouse enters the button area
button.addEventListener('mouseenter', () => dropdown.classList.remove('hidden'));

// Hide the dropdown when the mouse leaves the button, but wait a short moment
button.addEventListener('mouseleave', () => 
    setTimeout(() => { 
        // Only hide if the mouse is NOT over the dropdown
        if (!dropdown.matches(':hover')) dropdown.classList.add('hidden'); 
    }, 150) // 150ms delay to allow smooth movement to dropdown
);

// Keep the dropdown visible if the mouse enters the dropdown itself
dropdown.addEventListener('mouseenter', () => dropdown.classList.remove('hidden'));

// Hide the dropdown when the mouse leaves the dropdown area
dropdown.addEventListener('mouseleave', () => dropdown.classList.add('hidden');

    </script>
</body>
</html>