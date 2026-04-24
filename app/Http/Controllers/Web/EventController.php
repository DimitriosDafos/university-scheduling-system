<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Event;
use App\Models\Room;
use App\Models\User;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with(['room', 'user'])->orderBy('start_datetime')->paginate(25);

        return view('events.index', compact('events'));
    }

    public function create()
    {
        $rooms = Room::where('active', true)->get();
        $users = User::all();

        return view('events.create', compact('rooms', 'users'));
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->validated());

        return redirect()->route('events.index')->with('success', 'Event erstellt.');
    }

    public function edit(Event $event)
    {
        $rooms = Room::where('active', true)->get();
        $users = User::all();

        return view('events.edit', compact('event', 'rooms', 'users'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->validated());

        return redirect()->route('events.index')->with('success', 'Event aktualisiert.');
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event gelöscht.');
    }

    public function monitor()
    {
        $events = Event::with('room')->whereDate('start_datetime', now()->toDateString())
            ->orderBy('start_datetime')->get();

        return view('monitor.index', compact('events'));
    }
}
