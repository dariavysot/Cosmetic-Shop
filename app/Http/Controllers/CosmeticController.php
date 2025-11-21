<?php

namespace App\Http\Controllers;

use App\Models\Cosmetic;
use App\Models\Supplier;
use App\Models\Store;
use Illuminate\Http\Request;

class CosmeticController extends Controller
{
    public function index(Request $request)
    {
        $query = Cosmetic::query();

        if ($request->name) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }

        if ($request->supplier_id) {
            $query->where('supplier_id', $request->supplier_id);
        }

        $cosmetics = $query->with(['supplier', 'inventories.store'])->get();
        $suppliers = Supplier::all();

        return view('cosmetics.index', compact('cosmetics', 'suppliers'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('cosmetics.create', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string',
            'sku'         => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        Cosmetic::create($request->all());

        return redirect()->route('cosmetics.index')->with('success', 'Cosmetic added.');
    }

    public function edit(Cosmetic $cosmetic)
    {
        $suppliers = Supplier::all();
        return view('cosmetics.edit', compact('cosmetic', 'suppliers'));
    }

    public function update(Request $request, Cosmetic $cosmetic)
    {
        $request->validate([
            'name'        => 'required|string',
            'sku'         => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        $cosmetic->update($request->all());

        return redirect()->route('cosmetics.index')->with('success', 'Cosmetic updated.');
    }

    public function destroy(Cosmetic $cosmetic)
    {
        $cosmetic->delete();
        return redirect()->route('cosmetics.index')->with('success', 'Cosmetic removed.');
    }
}
