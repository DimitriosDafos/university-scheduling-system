<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'room_id',
        'user_id',
        'start_datetime',
        'end_datetime',
        'category',
        'all_day',
        'color',
        'recurrence_rule',
    ];

    protected $casts = [
        'start_datetime' => 'datetime',
        'end_datetime' => 'datetime',
        'all_day' => 'boolean',
    ];

    // Beziehungen
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recurrences()
    {
        return $this->hasMany(EventRecurrence::class);
    }

    // Hilfsfunktionen
    public function isOngoing(): bool
    {
        $now = Carbon::now();
        return $now->between($this->start_datetime, $this->end_datetime);
    }
}
