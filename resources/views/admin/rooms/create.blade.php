@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.rooms.index') }}" class="text-blue-600 hover:underline">← {{ __('Back') }}</a>
    </div>

    <div class="bg-white rounded shadow p-6 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-6">{{ __('Add Room') }}</h1>

        <form action="{{ route('admin.rooms.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">{{ __('Location') }}</label>
                <input type="text" name="location" value="{{ old('location') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">{{ __('Capacity') }}</label>
                <input type="number" name="capacity" value="{{ old('capacity') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('capacity')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="active" value="1" {{ old('active', true) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Active') }}</span>
                </label>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>
@endsection
