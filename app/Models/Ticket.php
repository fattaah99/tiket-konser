<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets'; // Nama tabel di database

    protected $fillable = [
        'event_id',
        'ticket_class',
        'price',
        'stock',
    ];

    /**
     * Relasi ke model Event
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}