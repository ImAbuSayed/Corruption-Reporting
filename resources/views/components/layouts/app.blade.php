<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Page Title' }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gradient-to-r from-yellow-400 to-pink-500 flex flex-col min-h-screen">
    <nav class="bg-gray-800 p-4">
        <div class="container mx-auto">
            <div class="flex justify-between items-center">
                <a href="{{ route('home') }}" class="text-white text-lg">Home</a>
                <div>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('reports.index') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium">Reports</a>
                            <a href="{{ route('create.report') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium">Create Report</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-white px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1 container mx-auto py-4">
        {{ $slot }}
    </main>

    <footer class="bg-gray-800 text-white text-center p-4">
        &copy; {{ date('Y') }} Corruption Reporting Platform. All rights reserved.
    </footer>

    @livewireScripts
</body>
</html>
