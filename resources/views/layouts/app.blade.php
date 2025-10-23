<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'MLD Forum') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon-1.png') }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <script>
        // Initialize theme before page renders to prevent flash
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="flex flex-col min-h-screen bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors">

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main Content -->
    <main class="flex-grow">
        <!-- Flash Messages -->
        @include('layouts.flash-messages')

        <!-- Page Content -->
        @yield('content')
    </main>

    <!-- Footer -->
    @include('layouts.footer')

    <!-- Scripts -->
    @include('layouts/partials.scripts')
</body>
</html>
