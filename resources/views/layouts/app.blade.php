<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen">
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
                <div class="flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}" class="text-lg font-semibold">{{ config('app.name') }}</a>
                    <div class="hidden space-x-4 sm:flex">
                        <a href="{{ route('dashboard') }}" class="text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">{{ __('Dashboard') }}</a>
                        <a href="{{ route('events.index') }}" class="text-sm font-medium {{ request()->routeIs('events.*') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">{{ __('Events') }}</a>
                        <a href="{{ route('monitor') }}" class="text-sm font-medium {{ request()->routeIs('monitor') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">{{ __('Monitor') }}</a>
                        
                        @can('view_admin_panel')
                            <a href="{{ route('admin.categories.index') }}" class="text-sm font-medium {{ request()->routeIs('admin.*') ? 'text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">{{ __('Admin') }}</a>
                        @endcan
                    </div>
                </div>
                
                <div class="flex items-center">
                    <!-- Language Switcher -->
                    <div class="mr-6 flex items-center space-x-2 text-sm font-medium border-r pr-6 border-gray-200">
                        <a href="{{ route('language.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'text-indigo-600 font-bold' : 'text-gray-400 hover:text-gray-600' }}">EN</a>
                        <span class="text-gray-300">|</span>
                        <a href="{{ route('language.switch', 'de') }}" class="{{ app()->getLocale() == 'de' ? 'text-indigo-600 font-bold' : 'text-gray-400 hover:text-gray-600' }}">DE</a>
                    </div>

                    @auth
                        <span class="mr-4">{{ auth()->user()->name }}</span>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                            class="text-sm text-red-600">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                    @endauth
                </div>
            </div>
        </nav>

        <main class="py-6">
            <div class="max-w-7xl mx-auto px-4">
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>

</html>
