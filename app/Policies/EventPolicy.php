<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
    /**
     * Determine if the given user can view the admin panel.
     */
    public function view_admin_panel(User $user): bool
    {
        return $user->isAdmin(); // Assuming isAdmin() method checks the 'role' attribute
    }

    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin','staff']);
    }

    public function view(User $user, Event $event): bool
    {
        return in_array($user->role, ['admin','staff']) || $user->id === $event->user_id;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin','staff']);
    }

    public function update(User $user, Event $event): bool
    {
        return $user->role === 'admin' || $user->id === $event->user_id;
    }

    public function delete(User $user, Event $event): bool
    {
        return $user->role === 'admin' || $user->id === $event->user_id;
    }
}
