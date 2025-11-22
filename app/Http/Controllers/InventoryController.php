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

    public function editForm()
    {
        $stores = \App\Models\Store::all(); // всі склади
        $cosmetics = \App\Models\Cosmetic::all(); // всі косметики

        return view('inventory.edit', compact('stores', 'cosmetics'));
    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'cosmetic_id' => 'required|exists:cosmetics,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $inventory = \App\Models\StoreInventory::where('store_id', $request->store_id)
            ->where('cosmetic_id', $request->cosmetic_id)
            ->first();

        if (!$inventory) {
            // Якщо ще немає запису для цього складу та косметики, створимо
            $inventory = \App\Models\StoreInventory::create([
                'store_id' => $request->store_id,
                'cosmetic_id' => $request->cosmetic_id,
                'quantity' => 0,
            ]);
        }

        $inventory->quantity += $request->quantity;
        $inventory->save();

        return back()->with('success', 'Кількість оновлено!');
    }

}
