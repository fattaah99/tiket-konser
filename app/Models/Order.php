<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'ticket_class',
        'buyer_name',
        'email',
        'quantity',
        'total_price',
        'status',
    ];

    /**
     * Relasi ke model Ticket (One-to-Many, satu tiket bisa memiliki banyak order).
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id'); // Pastikan foreign key benar
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    
}