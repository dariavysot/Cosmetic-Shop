<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreInventory extends Model
{
    protected $table = 'store_inventory';

    protected $fillable = [
        'cosmetic_id',
        'store_id',
        'quantity',
        'reserved_quantity'
    ];

    public function cosmetic()
    {
        return $this->belongsTo(Cosmetic::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
