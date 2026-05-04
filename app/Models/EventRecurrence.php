<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRecurrence extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'rrule',
        'until',
        'count',
        'exdates',
    ];

    protected $casts = [
        'until' => 'datetime',
        'exdates' => 'array',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
