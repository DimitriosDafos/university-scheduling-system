@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">← Zurück zum Dashboard</a>
    </div>
    
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-8">
            <div id="calendar" class="bg-white rounded shadow p-4"></div>
        </div>

        <div class="col-span-4">
            <div class="bg-white rounded shadow p-4">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Kommende Termine</h2>
                    <a href="{{ route('events.create') }}" class="text-sm bg-blue-600 text-white px-3 py-1 rounded">Neues
                        Event</a>
                </div>

                <ul>
                    @foreach ($events->take(10) as $event)
                        <li class="mb-3 border-b pb-2">
                            <div class="flex justify-between">
                                <div>
                                    <div class="font-medium">{{ $event->title }}</div>
                                    <div class="text-sm text-gray-600">{{ $event->room?->name ?? 'Kein Raum' }} •
                                        {{ $event->start_datetime->format('d.m.Y H:i') }}</div>
                                </div>
                                <div class="text-right">
                                    <a href="{{ route('events.edit', $event) }}"
                                        class="text-sm text-blue-600">Bearbeiten</a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                selectable: true,
                editable: true,
                navLinks: true,
                eventClick: function(info) {
                    // öffne Edit Seite
                    window.location.href = '/events/' + info.event.id + '/edit';
                },
                select: function(selectionInfo) {
                    // öffne Create mit vorausgefüllten Zeiten
                    const start = encodeURIComponent(selectionInfo.startStr);
                    const end = encodeURIComponent(selectionInfo.endStr);
                    window.location.href = '/events/create?start=' + start + '&end=' + end;
                },
                events: {
                    url: '/api/events',
                    method: 'GET',
                    failure: function() {
                        alert('Konnte Termine nicht laden.');
                    }
                },
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                }
            });

            calendar.render();
        });
    </script>
@endsection
