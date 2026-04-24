@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">← Zurück zum Dashboard</a>
    </div>
    
    <div class="bg-white rounded shadow p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Neues Event</h1>

        <form action="{{ route('events.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">Titel</label>
                    <input name="title" value="{{ old('title') }}" class="mt-1 block w-full border rounded p-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium">Kategorie</label>
                    <select name="category" class="mt-1 block w-full border rounded p-2">
                        <option value="lecture">Vorlesung</option>
                        <option value="exam">Prüfung</option>
                        <option value="event">Veranstaltung</option>
                        <option value="other">Sonstiges</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Raum</label>
                    <select name="room_id" class="mt-1 block w-full border rounded p-2">
                        <option value="">— Kein Raum —</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }} — {{ $room->location }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Dozent</label>
                    <select name="user_id" class="mt-1 block w-full border rounded p-2">
                        <option value="">— Kein Dozent —</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Start</label>
                    <input type="datetime-local" name="start_datetime"
                        value="{{ request('start') ? \Carbon\Carbon::parse(request('start'))->format('Y-m-d\TH:i') : old('start_datetime') }}"
                        class="mt-1 block w-full border rounded p-2" required>
                </div>

                <div>
                    <label class="block text-sm font-medium">Ende</label>
                    <input type="datetime-local" name="end_datetime"
                        value="{{ request('end') ? \Carbon\Carbon::parse(request('end'))->format('Y-m-d\TH:i') : old('end_datetime') }}"
                        class="mt-1 block w-full border rounded p-2" required>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium">Beschreibung</label>
                <textarea name="description" class="mt-1 block w-full border rounded p-2" rows="4">{{ old('description') }}</textarea>
            </div>

            <div class="mt-4 flex justify-end">
                <a href="{{ route('events.index') }}" class="mr-2 px-4 py-2 border rounded">Abbrechen</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Speichern</button>
            </div>
        </form>
    </div>
@endsection
