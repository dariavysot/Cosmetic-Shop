<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['name', 'address'];

    public function inventories()
    {
        return $this->hasMany(StoreInventory::class);
    }
}
