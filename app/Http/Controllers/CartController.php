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
            'cosmetic_id' => 'required|exists:cosmetics,id'
        ]);

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $cosmetic = Cosmetic::findOrFail($request->cosmetic_id);

        // Перевіряємо наявність хоча б 1 одиниці на складах
        $available = StoreInventory::where('cosmetic_id', $cosmetic->id)->sum('quantity');

        if ($available < 1) {
            return back()->with('error', 'Товару немає на складі.');
        }

        // Перевіряємо, чи вже є в кошику
        $existing = CartItem::where('cart_id', $cart->id)
            ->where('cosmetic_id', $cosmetic->id)
            ->first();

        if ($existing) {
            return redirect()->route('cart.index')
                ->with('info', 'Товар вже є у кошику. Ви можете змінити кількість там.');
        }

        // Додаємо товар з кількістю = 1
        CartItem::create([
            'cart_id' => $cart->id,
            'cosmetic_id' => $cosmetic->id,
            'quantity' => 1,
            'price_snapshot' => $cosmetic->price,
        ]);

        return redirect()->route('cart.index')
            ->with('success', 'Товар додано до кошика!');
    }

    public function update(Request $request, $id)
    {
        $item = CartItem::where('id', $id)
            ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
            ->firstOrFail();

        $available = StoreInventory::where('cosmetic_id', $item->cosmetic_id)->sum('quantity');

        if ($request->quantity > $available) {
            return back()->with('error', 'Недостатньо товару на складах.');
        }

        $item->quantity = max(1, $request->quantity);
        $item->save();

        return back()->with('success', 'Кількість змінено!');
    }

    public function destroy($id)
    {
        $item = CartItem::where('id', $id)
            ->whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
            ->firstOrFail();

        $item->delete();

        return back()->with('success', 'Товар видалено з кошика.');
    }
}
