<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'event_type',
        'location_id',
        'consequences',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];

    // An event belongs to a location
    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    // An event can have many characters
    public function characters()
    {
        return $this->belongsToMany(Character::class)
                    ->withPivot('involvement')
                    ->withTimestamps();
    }
}
