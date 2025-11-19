<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'cosmetic_id',
        'quantity',
        'price'
    ];

    public $timestamps = false;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function cosmetic()
    {
        return $this->belongsTo(Cosmetic::class);
    }
}
