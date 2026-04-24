@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">← Zurück zum Dashboard</a>
    </div>
    
    <div class="bg-white rounded shadow p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Event bearbeiten</h1>

        <form action="{{ route('events.update', $event) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Titel</label>
                    <input name="title" value="{{ old('title', $event->title) }}"
                        class="mt-1 block w-full border rounded p-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium">Kategorie</label>
                    <select name="category" class="mt-1 block w-full border rounded p-2">
                        <option value="lecture" @selected($event->category === 'lecture')>Vorlesung</option>
                        <option value="exam" @selected($event->category === 'exam')>Prüfung</option>
                        <option value="event" @selected($event->category === 'event')>Veranstaltung</option>
                        <option value="other" @selected($event->category === 'other')>Sonstiges</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Raum</label>
                    <select name="room_id" class="mt-1 block w-full border rounded p-2">
                        <option value="">— Kein Raum —</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" @selected($event->room_id == $room->id)>{{ $room->name }} —
                                {{ $room->location }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Dozent</label>
                    <select name="user_id" class="mt-1 block w-full border rounded p-2">
                        <option value="">— Kein Dozent —</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}" @selected($event->user_id == $u->id)>{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Start</label>
                    <input type="datetime-local" name="start_datetime"
                        value="{{ old('start_datetime', $event->start_datetime->format('Y-m-d\TH:i')) }}"
                        class="mt-1 block w-full border rounded p-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium">Ende</label>
                    <input type="datetime-local" name="end_datetime"
                        value="{{ old('end_datetime', $event->end_datetime->format('Y-m-d\TH:i')) }}"
                        class="mt-1 block w-full border rounded p-2" required>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium">Beschreibung</label>
                <textarea name="description" class="mt-1 block w-full border rounded p-2" rows="4">{{ old('description', $event->description) }}</textarea>
            </div>

            <div class="mt-4 flex justify-between">
                <form action="{{ route('events.destroy', $event) }}" method="POST"
                    onsubmit="return confirm('Event wirklich löschen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Löschen</button>
                </form>

                <div>
                    <a href="{{ route('events.index') }}" class="mr-2 px-4 py-2 border rounded">Abbrechen</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Speichern</button>
                </div>
            </div>
        </form>
    </div>
@endsection
