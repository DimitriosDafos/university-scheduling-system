@extends('layouts.app')

@section('content')
    <div class="bg-white rounded shadow overflow-hidden">
        <div class="p-4 border-b border-gray-200 flex justify-between items-center flex-wrap gap-4">
            <h2 class="text-xl font-semibold text-gray-800">{{ __('Upcoming Events') }}</h2>
            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-500">Sort by:</span>
                <a href="{{ route('events.index', ['sort' => 'date']) }}" class="px-3 py-1 text-sm rounded {{ $sortBy === 'date' ? 'bg-blue-600 text-white' : 'bg-gray-100 hover:bg-gray-200' }}">Date</a>
                <a href="{{ route('events.index', ['sort' => 'room']) }}" class="px-3 py-1 text-sm rounded {{ $sortBy === 'room' ? 'bg-blue-600 text-white' : 'bg-gray-100 hover:bg-gray-200' }}">Room</a>
                <a href="{{ route('events.index', ['sort' => 'lecturer']) }}" class="px-3 py-1 text-sm rounded {{ $sortBy === 'lecturer' ? 'bg-blue-600 text-white' : 'bg-gray-100 hover:bg-gray-200' }}">Lecturer</a>
            </div>
            <a href="{{ route('events.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm ml-auto">
                {{ __('Add Event') }}
            </a>
        </div>
        
        <div class="p-4">
            @if($events->isEmpty())
                <p class="text-gray-500 text-center py-8">No upcoming events.</p>
            @else
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500 border-b">
                            <th class="pb-2">Title</th>
                            <th class="pb-2">Room</th>
                            <th class="pb-2">Lecturer</th>
                            <th class="pb-2">Date</th>
                            <th class="pb-2">Time</th>
                            <th class="pb-2 w-24">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $event)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 font-medium">{{ $event->title }}</td>
                                <td class="py-3">{{ $event->room?->name ?? '-' }}</td>
                                <td class="py-3">{{ $event->user?->name ?? '-' }}</td>
                                <td class="py-3">{{ $event->start_datetime->format('d.m.Y') }}</td>
                                <td class="py-3">{{ $event->start_datetime->format('H:i') }} - {{ $event->end_datetime->format('H:i') }}</td>
                                <td class="py-3">
                                    <a href="{{ route('events.edit', $event) }}" class="text-blue-600 hover:underline mr-2">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection