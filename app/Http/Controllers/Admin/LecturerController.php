<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class LecturerController extends Controller
{
    public function index()
    {
        $lecturers = User::all();
        return view('admin.lecturers.index', compact('lecturers'));
    }

    public function create()
    {
        return view('admin.lecturers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,staff,viewer'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.lecturers.index')->with('success', __('Lecturer created.'));
    }

    public function edit(User $lecturer)
    {
        return view('admin.lecturers.edit', compact('lecturer'));
    }

    public function update(Request $request, User $lecturer)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email,'.$lecturer->id],
            'role' => ['required', 'in:admin,staff,viewer'],
        ]);

        $lecturer->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $lecturer->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('admin.lecturers.index')->with('success', __('Lecturer updated.'));
    }

    public function destroy(User $lecturer)
    {
        if ($lecturer->id === auth()->id()) {
            return redirect()->back()->with('error', __('Cannot delete yourself.'));
        }

        if ($lecturer->events()->exists()) {
            return redirect()->back()->with('error', __('Cannot delete lecturer with associated events.'));
        }

        $lecturer->delete();

        return redirect()->route('admin.lecturers.index')->with('success', __('Lecturer deleted.'));
    }
}
