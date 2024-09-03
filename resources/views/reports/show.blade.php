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
                            <a href="{{ route('reports.index') }}"
                                class="text-white px-3 py-2 rounded-md text-sm font-medium">Reports</a>
                            <a href="{{ route('create.report') }}"
                                class="text-white px-3 py-2 rounded-md text-sm font-medium">Create Report</a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit"
                                    class="text-white px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-white px-3 py-2 rounded-md text-sm font-medium">Log
                                in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"
                                    class="text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1 container mx-auto py-4">
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-3xl font-bold mb-4">{{ $report->title }}</h1>

            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="mb-4">
                    <strong class="text-gray-700">Category:</strong>
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded ml-2">{{ $report->category }}</span>
                </div>

                @if ($report->thumbnail)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $report->thumbnail) }}" alt="{{ $report->title }}"
                        class="w-[60%] h-48 sm:h-64 md:h-80 object-cover rounded-lg cursor-pointer"
                        onclick="openImagePopup(this.src)">
                </div>
            
                <!-- Image Popup -->
                <div id="imagePopup" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden">
                    <div class="max-w-screen-lg max-h-screen overflow-auto">
                        <img id="popupImage" src="" alt="Full size image" class="max-w-full max-h-full">
                    </div>
                    <button onclick="closeImagePopup()" class="absolute top-4 right-4 text-white text-2xl">&times;</button>
                </div>
            @endif

                <div class="prose max-w-none">
                    {!! nl2br(e($report->description)) !!}
                </div>

                @if ($report->report_status)
                    <div class="mt-4">
                        <strong class="text-gray-700">Status:</strong>
                        <span
                            class="bg-green-100 text-green-800 px-2 py-1 rounded ml-2">{{ $report->report_status }}</span>
                    </div>
                @endif

                <div class="mt-4">
                    <strong class="text-gray-700">Reported on:</strong>
                    <span>{{ $report->created_at->format('F j, Y') }}</span>
                </div>

                @if ($report->files->count() > 0)
                    <div class="mt-6">
                        <h3 class="text-xl font-semibold mb-2">Attachments</h3>
                        <ul class="list-disc pl-5">
                            @foreach ($report->files as $file)
                                <li>
                                    <a href="{{ asset('storage/' . $file->path) }}" target="_blank"
                                        class="text-blue-600 hover:underline">
                                        {{ basename($file->path) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="mt-8">
                <a href="{{ route('public.reports') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Back to Reports
                </a>
            </div>
        </div>
    </main>

    <footer class="bg-gray-800 text-white text-center p-4">
        &copy; {{ date('Y') }} Corruption Reporting Platform. All rights reserved.
    </footer>

    @livewireScripts
</body>

</html>
<script>
    function openImagePopup(src) {
        document.getElementById('popupImage').src = src;
        document.getElementById('imagePopup').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeImagePopup() {
        document.getElementById('imagePopup').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close popup when clicking outside the image
    document.getElementById('imagePopup').addEventListener('click', function(e) {
        if (e.target === this) {
            closeImagePopup();
        }
    });
</script>