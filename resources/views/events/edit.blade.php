@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{ route('events.index') }}" class="text-blue-600 hover:underline">← {{ __('Back to Dashboard') }}</a>
    </div>
    
    <div class="bg-white rounded shadow p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">{{ $event->id ? __('Edit Event') : __('Add Event') }}</h1>

        <form action="{{ $event->id ? route('events.update', $event) : route('events.store') }}" method="POST">
            @csrf
            @if($event->id)
                @method('PUT')
            @endif

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium">{{ __('Title') }}</label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">{{ __('Category') }}</label>
                    <select name="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">— {{ __('Select Category') }} —</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(old('category_id', $event->category_id) == $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">{{ __('Room') }}</label>
                    <select name="room_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">— {{ __('No Room') }} —</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" @selected($event->room_id == $room->id)>{{ $room->name }} — {{ $room->location }}</option>
                        @endforeach
                    </select>
                    @error('room_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">{{ __('Lecturer') }}</label>
                    <select name="user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">— {{ __('No Lecturer') }} —</option>
                        @foreach ($users as $u)
                            <option value="{{ $u->id }}" @selected($event->user_id == $u->id)>{{ $u->name }}</option>
                        @endforeach
                    </select>
                     @error('user_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">{{ __('Start') }}</label>
                    <input type="datetime-local" name="start_datetime"
                        value="{{ old('start_datetime', $event->start_datetime?->format('Y-m-d\TH:i')) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    @error('start_datetime')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium">{{ __('End') }}</label>
                    <input type="datetime-local" name="end_datetime"
                        value="{{ old('end_datetime', $event->end_datetime?->format('Y-m-d\TH:i')) }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                    @error('end_datetime')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium">{{ __('Description') }}</label>
                <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" rows="4">{{ old('description', $event->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4 flex justify-end">
                <a href="{{ route('events.index') }}" class="mr-2 px-4 py-2 border rounded hover:bg-gray-100 transition">{{ __('Cancel') }}</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">{{ __('Save') }}</button>
            </div>
        </form>
    </div>
@endsection
