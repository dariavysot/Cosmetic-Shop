<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\StoreInventory;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $stores = Store::all();
        return view('stores.index', compact('stores'));
    }

    public function create()
    {
        return view('stores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'nullable|string',
        ]);

        Store::create($request->all());

        return redirect()->route('stores.index')->with('success', 'Store created.');
    }

    public function edit(Store $store)
    {
        return view('stores.edit', compact('store'));
    }

    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'nullable|string',
        ]);

        $store->update($request->all());

        return redirect()->route('stores.index')->with('success', 'Store updated.');
    }

    public function destroy(Store $store)
    {
        $store->delete();
        return redirect()->route('stores.index')->with('success', 'Store deleted.');
    }

    // Показ списку товарів на конкретному складі
    public function inventory(Store $store)
    {
        $items = StoreInventory::with('cosmetic')
            ->where('store_id', $store->id)
            ->get();

        return view('stores.inventory', compact('store', 'items'));
    }
}
