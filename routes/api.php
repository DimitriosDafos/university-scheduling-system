<?php

use App\Models\Event;
use App\Models\Room;
use Illuminate\Support\Facades\Route;

Route::get('events', function () {
    $events = Event::with('room')->get()->map(function ($event) {
        return [
            'id' => $event->id,
            'title' => $event->title,
            'start' => $event->start_datetime,
            'end' => $event->end_datetime,
            'backgroundColor' => $event->color,
            'resourceId' => $event->room_id,
        ];
    });

    return response()->json($events);
});

Route::get('rooms', function () {
    $rooms = Room::where('active', true)->get()->map(function ($room) {
        return [
            'id' => $room->id,
            'title' => $room->name.' - '.$room->location,
        ];
    });

    return response()->json($rooms);
});
