<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'transaction_id',
        'menu_id',
        'qty',
        'subtotal'
    ];
}