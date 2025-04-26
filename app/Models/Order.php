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
        'user_id', 
    ];

    /**
     * Relasi ke model Ticket (One-to-Many, satu tiket bisa memiliki banyak order).
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    /**
     * Relasi ke model User (Many orders belong to one user).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Ini sepertinya tidak diperlukan karena Order tidak punya child Order.
     * Bisa dihapus jika tidak digunakan.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}