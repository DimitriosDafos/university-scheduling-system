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

            <main id="auto-scroll-container" class="p-6 max-h-[65vh] overflow-y-auto scrollbar-hide">
                <div id="scroll-content" class="space-y-6">
                    @forelse ($events->groupBy(fn($e) => $e->room?->name ?? __('Unknown')) as $roomName => $roomEvents)
                        <div class="border-l-4 border-blue-900 pl-4 py-1">
                            <h2 class="text-2xl font-black mb-3 uppercase tracking-tight text-blue-800">{{ $roomName }}</h2>
                            <div class="grid gap-3">
                                @foreach ($roomEvents as $ev)
                                    <div class="bg-blue-50 p-4 rounded-xl flex justify-between items-center border border-blue-100">
                                        <div class="flex-1">
                                            <div class="text-xl font-bold leading-tight">{{ $ev->title }}</div>
                                            <div class="text-base text-gray-500 italic">{{ $ev->user?->name ?? __('Unknown') }}</div>
                                        </div>
                                        <div class="text-2xl font-mono font-black text-blue-900 bg-white px-3 py-1 rounded-lg shadow-sm border border-blue-200 ml-4">
                                            {{ \Carbon\Carbon::parse($ev->start_datetime)->format('H:i') }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div class="text-2xl font-bold text-gray-400 uppercase italic">{{ __('No events for today') }}</div>
                        </div>
                    @endforelse
                </div>
            </main>
        </div>
    </div>

    <style>
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <script>
        function initAutoScroll() {
            const container = document.getElementById('auto-scroll-container');
            const content = document.getElementById('scroll-content');
            if (!container || !content) return;

            let scrollSpeed = 1; // pixels per frame
            let direction = 1; // 1 for down, -1 for up
            let delayCounter = 0;
            const pauseDuration = 180; // ~3 seconds at 60fps

            function scroll() {
                if (container.scrollHeight <= container.clientHeight) return;

                if (delayCounter > 0) {
                    delayCounter--;
                } else {
                    container.scrollTop += scrollSpeed * direction;

                    // Hit bottom
                    if (direction === 1 && container.scrollTop + container.clientHeight >= container.scrollHeight - 1) {
                        direction = -1;
                        delayCounter = pauseDuration;
                    } 
                    // Hit top
                    else if (direction === -1 && container.scrollTop <= 0) {
                        direction = 1;
                        delayCounter = pauseDuration;
                    }
                }
                requestAnimationFrame(scroll);
            }
            
            // Start after a small initial delay
            setTimeout(() => requestAnimationFrame(scroll), 2000);
        }

        function updateClock() {
            const el = document.getElementById('clock');
            if (!el) return;
            const now = new Date();
            el.textContent = now.toLocaleTimeString('{{ str_replace('_', '-', app()->getLocale()) }}', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }
        setInterval(updateClock, 1000);
        updateClock();
        initAutoScroll();

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
