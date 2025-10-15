<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    
    protected $fillable = [
        'user_id',
        'booking_id',
        'amount',
        'credit',
        'debit',
        'type',
        'payment_id',
        'payment_method',
        'payment_status',
        'remarks',
    ];
}
