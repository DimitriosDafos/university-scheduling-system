@extends('layouts.app')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold">{{ __('Dashboard') }}</h1>
    </div>
    
    <div class="flex flex-col md:flex-row gap-6">
        <a href="{{ route('events.index') }}" class="flex-1 p-8 bg-blue-50 rounded-lg hover:bg-blue-100 transition text-center">
            <h3 class="font-semibold text-xl text-blue-800">{{ __('Events') }}</h3>
            <p class="text-blue-600">{{ __('Manage calendar events') }}</p>
        </a>
        
        <a href="{{ route('monitor') }}" class="flex-1 p-8 bg-purple-50 rounded-lg hover:bg-purple-100 transition text-center">
            <h3 class="font-semibold text-xl text-purple-800">{{ __('Monitor') }}</h3>
            <p class="text-purple-600">{{ __('View public display') }}</p>
        </a>
        
        @can('view_admin_panel')
            <a href="{{ route('admin.dashboard') }}" class="flex-1 p-8 bg-gray-50 rounded-lg hover:bg-gray-100 transition text-center">
                <h3 class="font-semibold text-xl text-gray-800">{{ __('Admin Panel') }}</h3>
                <p class="text-gray-600">{{ __('Manage system settings') }}</p>
            </a>
        @endcan
    </div>
@endsection
