<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Cosmetic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id()
        ]);

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

        $item = CartItem::where('cart_id', $cart->id)
            ->where('cosmetic_id', $cosmetic->id)
            ->first();

        if ($item) {
            $item->quantity += $request->quantity;
            $item->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'cosmetic_id' => $cosmetic->id,
                'quantity' => $request->quantity,
                'price_snapshot' => $cosmetic->price,
            ]);
        }

        return back()->with('success', 'Item added to cart.');
    }

    public function update(Request $request, $id)
    {
        $item = CartItem::findOrFail($id);
        $item->quantity = max(1, $request->quantity);
        $item->save();

        return back()->with('success', 'Updated.');
    }

    public function destroy($id)
    {
        CartItem::findOrFail($id)->delete();
        return back()->with('success', 'Deleted.');
    }
}
