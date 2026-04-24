<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white min-h-screen flex flex-col">
    <main class="flex-1 flex items-center justify-center px-6">
        <div class="text-center max-w-2xl">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">
                {{ __('University Room Info Board') }}
            </h1>
            <p class="text-lg text-white/70 mb-8">
                {{ __('Manage room schedules and events efficiently') }}
            </p>

@guest
                <div class="flex flex-col sm:flex-row gap-4 justify-center mt-8">
                    <a href="{{ route('login') }}"
                        class="px-10 py-4 bg-white text-slate-900 rounded-lg hover:bg-gray-100 transition font-bold text-center">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-10 py-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-bold text-center">
                            Register
                        </a>
                    @endif
                </div>
            @endguest
        </div>
    </main>

    <footer class="p-6 text-center text-white/50 text-sm">
        <div class="flex justify-center gap-4 mb-2">
            <a href="{{ route('language.switch', 'en') }}"
                class="{{ app()->getLocale() == 'en' ? 'text-white font-bold' : 'text-white/50 hover:text-white' }}">
                EN
            </a>
            <span class="text-white/30">|</span>
            <a href="{{ route('language.switch', 'de') }}"
                class="{{ app()->getLocale() == 'de' ? 'text-white font-bold' : 'text-white/50 hover:text-white' }}">
                DE
            </a>
        </div>
        &copy; {{ date('Y') }} {{ config('app.name') }}
    </footer>
</body>

</html>