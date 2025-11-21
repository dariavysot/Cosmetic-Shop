<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Cosmetic;
use App\Models\StoreInventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = StoreInventory::with(['cosmetic', 'store'])->get();
        return view('inventory.index', compact('inventory'));
    }

    public function addForm()
    {
        return view('inventory.add', [
            'cosmetics' => Cosmetic::all(),
            'stores' => Store::all()
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'cosmetic_id' => 'required|exists:cosmetics,id',
            'store_id' => 'required|exists:stores,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $row = StoreInventory::firstOrCreate([
            'cosmetic_id' => $request->cosmetic_id,
            'store_id' => $request->store_id,
        ]);

        $row->quantity += $request->quantity;
        $row->save();

        return back()->with('success', 'Stock updated.');
    }
}
