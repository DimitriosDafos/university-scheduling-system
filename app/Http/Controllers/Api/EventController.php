<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with(['room', 'user'])->orderBy('start_datetime');

        if ($request->filled('room_id')) {
            $query->where('room_id', $request->query('room_id'));
        }

        if ($request->filled('from')) {
            $query->where('start_datetime', '>=', $request->query('from'));
        }

        if ($request->filled('to')) {
            $query->where('end_datetime', '<=', $request->query('to'));
        }

        $perPage = (int) $request->query('per_page', 25);

        return EventResource::collection($query->paginate($perPage));
    }

    public function store(StoreEventRequest $request)
    {
        $this->authorize('create', Event::class);

        $data = $request->validated();
        $event = Event::create($data);

        return new EventResource($event->load(['room', 'user']));
    }

    public function show(Event $event)
    {
        $this->authorize('view', $event);

        return new EventResource($event->load(['room', 'user']));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $this->authorize('update', $event);

        $event->update($request->validated());

        return new EventResource($event->fresh(['room', 'user']));
    }

    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);

        $event->delete();

        return response()->noContent();
    }

    // Zusätzliche Hilfsendpoints

    public function byRoom($roomId)
    {
        $events = Event::with('user')->where('room_id', $roomId)
            ->whereDate('start_datetime', now()->toDateString())
            ->orderBy('start_datetime')
            ->get();

        return EventResource::collection($events);
    }

    public function current()
    {
        $now = now();
        $events = Event::with(['room', 'user'])
            ->where('start_datetime', '<=', $now)
            ->where('end_datetime', '>=', $now)
            ->orderBy('start_datetime')
            ->get();

        return EventResource::collection($events);
    }
}
