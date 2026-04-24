<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Monitor - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-blue-900 font-sans antialiased overflow-hidden">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-2/3 bg-white shadow-2xl rounded-3xl overflow-hidden border-2 border-blue-900">
            
            <header class="bg-blue-900 text-white p-8 flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-black uppercase tracking-widest">{{ config('app.name') }}</h1>
                    <div class="text-xl font-medium opacity-90 mt-1">{{ now()->translatedFormat('l, d. F Y') }}</div>
                </div>
                <div id="clock" class="text-6xl font-mono font-bold"></div>
            </header>

            <main class="p-8 max-h-[70vh] overflow-y-auto">
                <div class="space-y-8">
                    @forelse ($events->groupBy(fn($e) => $e->room?->name ?? 'Unbekannt') as $roomName => $roomEvents)
                        <div class="border-l-8 border-blue-900 pl-6 py-2">
                            <h2 class="text-3xl font-black mb-4 uppercase tracking-tight text-blue-800">{{ $roomName }}</h2>
                            <div class="grid gap-4">
                                @foreach ($roomEvents as $ev)
                                    <div class="bg-blue-50 p-5 rounded-2xl flex justify-between items-center border border-blue-100">
                                        <div class="flex-1">
                                            <div class="text-2xl font-bold">{{ $ev->title }}</div>
                                            <div class="text-lg text-gray-500 italic">{{ $ev->user?->name }}</div>
                                        </div>
                                        <div class="text-3xl font-mono font-black text-blue-900 bg-white px-4 py-2 rounded-xl shadow-sm border border-blue-200">
                                            {{ \Carbon\Carbon::parse($ev->start_datetime)->format('H:i') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div class="text-3xl font-bold text-gray-400 uppercase italic">Keine Termine für heute</div>
                        </div>
                    @endforelse
                </div>
            </main>
        </div>
    </div>

    <script>
        function updateClock() {
            const el = document.getElementById('clock');
            if (!el) return;
            const now = new Date();
            el.textContent = now.toLocaleTimeString('de-DE', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Auto refresh alle 30 Sekunden
        setInterval(() => {
            fetch(location.href, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(r => r.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newMain = doc.querySelector('main');
                    if (newMain) document.querySelector('main').innerHTML = newMain.innerHTML;
                }).catch(() => {});
        }, 30000);
    </script>
</body>
</html>
