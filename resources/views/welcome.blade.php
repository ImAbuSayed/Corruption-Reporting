<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <link href="//cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #f6d365 0%, #fda085 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: 'Nunito', sans-serif;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        .nav-link {
            transition: color 0.3s;
        }
        .nav-link:hover {
            color: #ffb676;
        }
    </style>
</head>
<body>
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <!-- Welcome Container -->
        <div class="container">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">
                <i class="fas fa-shield-alt"></i> Welcome to the Corruption Reporting Platform
            </h1>
            <p class="text-lg text-gray-600 mb-4">Your trusted tool for reporting and managing corruption cases with transparency and efficiency.</p>

            <!-- Navigation Links -->
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Get Started</h2>
            <div class="flex justify-center space-x-4 mb-8">
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition-colors duration-300 nav-link">
                    <i class="fas fa-sign-in-alt"></i> Log In
                </a>
                <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full transition-colors duration-300 nav-link">
                    <i class="fas fa-user-plus"></i> Create Account
                </a>
                <a href="{{ route('public.reports') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full transition-colors duration-300 nav-link">
                    <i class="fas fa-file-alt"></i> View Reports
                </a>
            </div>

            <!-- Instructions -->
            <div class="text-left">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Instructions</h2>
                <ul class="list-disc text-gray-600 mb-4 pl-6">
                    <li class="mb-2">To log in or register, click on the respective buttons above.</li>
                    <li class="mb-2">Once logged in, you can create a new report by navigating to the 'Create New Report' section.</li>
                    <li class="mb-2">Fill in the necessary details such as the title, description, and status of the report.</li>
                    <li class="mb-2">Your details will remain anonymous to ensure your privacy and protection.</li>
                </ul>
            </div>

            <!-- Information about the project -->
            <div class="text-left">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Project Details</h2>
                <p class="text-gray-600 mb-2">This platform is developed to facilitate the easy reporting and management of corruption cases.</p>
                <p class="text-gray-600 mb-4">Check out the project repository on GitHub:</p>
                <a href="https://github.com/ImAbuSayed/corruption-reporting" class="text-blue-500 hover:underline nav-link" target="_blank">
                    <i class="fab fa-github"></i> GitHub Repository
                </a>
            </div>
        </div>
    </div>

    <footer class="bg-gray-800 text-white text-center py-4 mt-8">
        &copy; {{ date('Y') }} Corruption Reporting Platform. All rights reserved.
    </footer>

    <script>
        // Add any JavaScript you need here
    </script>
</body>
</html>
