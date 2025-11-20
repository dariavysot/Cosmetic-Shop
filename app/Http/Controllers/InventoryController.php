<?php

namespace App\Http\Controllers;

use App\Models\Cosmetic;
use App\Models\StoreInventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = StoreInventory::with('cosmetic')->get();
        return view('inventory.index', compact('inventory'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'cosmetic_id' => 'required|exists:cosmetics,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $row = StoreInventory::firstOrCreate(
            ['cosmetic_id' => $request->cosmetic_id]
        );

        $row->quantity += $request->quantity;
        $row->save();

        return back()->with('success', 'Product added to stock.');
    }
}
