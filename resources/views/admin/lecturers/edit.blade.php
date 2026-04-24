@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.lecturers.index') }}" class="text-blue-600 hover:underline">← {{ __('Back') }}</a>
    </div>

    <div class="bg-white rounded shadow p-6 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-6">{{ __('Edit Lecturer') }}</h1>

        <form action="{{ route('admin.lecturers.update', $lecturer) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
                <input type="text" name="name" value="{{ old('name', $lecturer->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
                <input type="email" name="email" value="{{ old('email', $lecturer->email) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">{{ __('Role') }}</label>
                <select name="role" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="staff" @selected(old('role', $lecturer->role) == 'staff')>Staff (Lecturer)</option>
                    <option value="viewer" @selected(old('role', $lecturer->role) == 'viewer')>Viewer</option>
                    <option value="admin" @selected(old('role', $lecturer->role) == 'admin')>Admin</option>
                </select>
                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">{{ __('New Password') }} ({{ __('Optional') }})</label>
                <input type="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">{{ __('Confirm Password') }}</label>
                <input type="password" name="password_confirmation" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                    {{ __('Save') }}
                </button>
            </div>
        </form>
    </div>
@endsection