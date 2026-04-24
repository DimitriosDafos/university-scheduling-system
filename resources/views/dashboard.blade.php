@extends('layouts.app')

@section('content')
    <div class="mb-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold">{{ __('Dashboard') }}</h1>
    </div>
    
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h2 class="text-2xl font-bold mb-4">{{ __('Welcome, :name!', ['name' => Auth::user()->name]) }}</h2>
            <p class="mb-4">{{ __("You're logged in to the University Information Screen.") }}</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <a href="{{ route('events.index') }}" class="p-6 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                    <h3 class="font-semibold text-lg text-blue-800">{{ __('Events') }}</h3>
                    <p class="text-blue-600">{{ __('Manage calendar events') }}</p>
                </a>
                <a href="{{ route('events.create') }}" class="p-6 bg-green-50 rounded-lg hover:bg-green-100 transition">
                    <h3 class="font-semibold text-lg text-green-800">{{ __('Add Event') }}</h3>
                    <p class="text-green-600">{{ __('Create a new event') }}</p>
                </a>
                <a href="{{ route('monitor') }}" class="p-6 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                    <h3 class="font-semibold text-lg text-purple-800">{{ __('Monitor') }}</h3>
                    <p class="text-purple-600">{{ __('View public display') }}</p>
                </a>
                
                @can('view_admin_panel')
                    <a href="{{ route('admin.categories.index') }}" class="p-6 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <h3 class="font-semibold text-lg text-gray-800">{{ __('Admin Panel') }}</h3>
                        <p class="text-gray-600">{{ __('Manage system settings') }}</p>
                    </a>
                @endcan
            </div>
        </div>
    </div>
@endsection
