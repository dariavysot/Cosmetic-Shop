<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreInventory extends Model
{
    protected $table = 'store_inventory';

    protected $fillable = [
        'cosmetic_id',
        'quantity',
    ];

    public function cosmetic()
    {
        return $this->belongsTo(Cosmetic::class);
    }
}
