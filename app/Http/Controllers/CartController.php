<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Cosmetic;
use App\Models\StoreInventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $items = $cart->items()->with('cosmetic')->get();

        $total = $items->sum(fn($item) => $item->quantity * $item->price_snapshot);

        return view('cart.index', compact('cart', 'items', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'cosmetic_id' => 'required|exists:cosmetics,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $cosmetic = Cosmetic::findOrFail($request->cosmetic_id);

        // Перевірка наявності на складах
        $available = StoreInventory::where('cosmetic_id', $cosmetic->id)->sum('quantity');

        $existing = CartItem::where('cart_id', $cart->id)
            ->where('cosmetic_id', $cosmetic->id)
            ->first();

        $requestedTotal = ($existing?->quantity ?? 0) + $request->quantity;

        if ($requestedTotal > $available) {
            return back()->with('error', 'Not enough stock in stores.');
        }

        if ($existing) {
            $existing->quantity += $request->quantity;
            $existing->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'cosmetic_id' => $cosmetic->id,
                'quantity' => $request->quantity,
                'price_snapshot' => $cosmetic->price,
            ]);
        }

         return redirect()->route('cart.index')
        ->with('success', 'Товар додано до кошика!');
    }

    public function update(Request $request, $id)
    {
        $item = CartItem::where('id', $id)
            ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
            ->firstOrFail();

        // Перевірка наявності
        $available = StoreInventory::where('cosmetic_id', $item->cosmetic_id)->sum('quantity');

        if ($request->quantity > $available) {
            return back()->with('error', 'Not enough stock.');
        }

        $item->quantity = max(1, $request->quantity);
        $item->save();

        return back()->with('success', 'Updated.');
    }

    public function destroy($id)
    {
        $item = CartItem::where('id', $id)
            ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
            ->firstOrFail();

        $item->delete();

        return back()->with('success', 'Deleted.');
    }
}
