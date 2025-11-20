<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StoreInventory;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('items.cosmetic')
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->count() === 0) {
            return back()->with('error', 'Your cart is empty.');
        }

        $total = 0;

        // Перевірка залишків
        foreach ($cart->items as $item) {
            $inventory = StoreInventory::where('cosmetic_id', $item->cosmetic_id)->first();

            if (!$inventory || $inventory->quantity < $item->quantity) {
                return back()->with('error', "Not enough goods: {$item->cosmetic->name}");
            }
        }

        // Створюємо замовлення
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => 0,
            'status' => 'created'
        ]);

        // Додаємо позиції замовлення + списуємо зі складу
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'cosmetic_id' => $item->cosmetic_id,
                'quantity' => $item->quantity,
                'price' => $item->price_snapshot,
            ]);

            $total += $item->price_snapshot * $item->quantity;

            $inventory = StoreInventory::where('cosmetic_id', $item->cosmetic_id)->first();
            $inventory->quantity -= $item->quantity;
            $inventory->save();
        }

        $order->total_price = $total;
        $order->save();

        // Очищаємо корзину
        $cart->items()->delete();

        return redirect()->route('orders.index')
                         ->with('success', 'Order created!');
    }
}
