<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'nullable|integer|min:0',
            'active' => 'boolean',
        ]);

        $validated['active'] = $request->has('active');

        Room::create($validated);

        return redirect()->route('admin.rooms.index')->with('success', __('Room created.'));
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'nullable|integer|min:0',
            'active' => 'boolean',
        ]);

        $validated['active'] = $request->has('active');

        $room->update($validated);

        return redirect()->route('admin.rooms.index')->with('success', __('Room updated.'));
    }

    public function destroy(Room $room)
    {
        if ($room->events()->exists()) {
            return redirect()->back()->with('error', __('Cannot delete room with associated events.'));
        }

        $room->delete();

        return redirect()->route('admin.rooms.index')->with('success', __('Room deleted.'));
    }
}
