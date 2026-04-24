@extends('layouts.app')

@section('content')
    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">{{ __('Admin Panel') }}</h1>
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <div class="p-6">
            <h2 class="text-xl font-semibold mb-4">{{ __('Management Sections') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('admin.categories.index') }}" class="block p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition text-blue-800 hover:text-blue-900">
                    <h3 class="font-semibold text-lg">{{ __('Manage Categories') }}</h3>
                    <p class="text-sm">{{ __('Organize event categories') }}</p>
                </a>
                <a href="{{ route('admin.rooms.index') }}" class="block p-4 bg-green-50 rounded-lg hover:bg-green-100 transition text-green-800 hover:text-green-900">
                    <h3 class="font-semibold text-lg">{{ __('Manage Rooms') }}</h3>
                    <p class="text-sm">{{ __('Manage available rooms') }}</p>
                </a>
                <a href="{{ route('admin.lecturers.index') }}" class="block p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition text-purple-800 hover:text-purple-900">
                    <h3 class="font-semibold text-lg">{{ __('Manage Lecturers') }}</h3>
                    <p class="text-sm">{{ __('Manage user accounts') }}</p>
                </a>
            </div>
        </div>
    </div>
@endsection
