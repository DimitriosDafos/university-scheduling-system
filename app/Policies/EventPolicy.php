<?php

namespace App\Policies;

use App\Models\Event;
use App\Models\User;

class EventPolicy
{
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
