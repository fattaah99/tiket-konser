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
        'location',
    ];

    protected $casts = [
        'event_date' => 'datetime',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function galleries()
    {
        return $this->hasMany(EventGallery::class);
    }
}