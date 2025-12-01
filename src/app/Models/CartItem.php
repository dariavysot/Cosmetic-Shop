<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id',
        'cosmetic_id',
        'quantity',
        'price_snapshot'
    ];

    public $timestamps = false;

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function cosmetic()
    {
        return $this->belongsTo(Cosmetic::class);
    }
}
