<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ config('app.name') }} - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen">
        <nav class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('dashboard') }}" class="text-xl font-bold">{{ config('app.name') }}</a>
                        </div>
                        <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium text-gray-900">Dashboard</a>
                            <a href="{{ route('events.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700">Events</a>
                            <a href="{{ route('monitor') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-gray-500 hover:text-gray-700">Monitor</a>
                        </div>
                    </div>
                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <span class="mr-4">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-2xl font-bold mb-4">Welcome, {{ Auth::user()->name }}!</h2>
                        <p class="mb-4">You're logged in to the University Information Screen.</p>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                            <a href="{{ route('events.index') }}" class="p-6 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                                <h3 class="font-semibold text-lg text-blue-800">Events</h3>
                                <p class="text-blue-600">Manage calendar events</p>
                            </a>
                            <a href="{{ route('events.create') }}" class="p-6 bg-green-50 rounded-lg hover:bg-green-100 transition">
                                <h3 class="font-semibold text-lg text-green-800">Add Event</h3>
                                <p class="text-green-600">Create a new event</p>
                            </a>
                            <a href="{{ route('monitor') }}" class="p-6 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                                <h3 class="font-semibold text-lg text-purple-800">Monitor</h3>
                                <p class="text-purple-600">View public display</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>