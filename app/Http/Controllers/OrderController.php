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

        // 1. Перевірка залишків у ПЕРШОМУ складі
        foreach ($cart->items as $item) {
            $inventory = StoreInventory::where('cosmetic_id', $item->cosmetic_id)
                ->where('quantity', '>=', $item->quantity)
                ->first(); // беремо перший склад з достатньою кількістю

            if (!$inventory) {
                return back()->with('error', "Not enough goods: {$item->cosmetic->name}");
            }
        }

        // 2. Створюємо замовлення
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => 0,
            'status' => 'created'
        ]);

        // 3. Додаємо позиції + списуємо з першого відповідного складу
        foreach ($cart->items as $item) {

            // Знаходимо склад для списання
            $inventory = StoreInventory::where('cosmetic_id', $item->cosmetic_id)
                ->where('quantity', '>=', $item->quantity)
                ->first();

            // Створюємо позицію замовлення
            OrderItem::create([
                'order_id' => $order->id,
                'cosmetic_id' => $item->cosmetic_id,
                'quantity' => $item->quantity,
                'price' => $item->price_snapshot,
            ]);

            $total += $item->price_snapshot * $item->quantity;

            // Списуємо
            $inventory->quantity -= $item->quantity;
            $inventory->save();
        }

        $order->total_price = $total;
        $order->save();

        // 4. Очищаємо кошик
        $cart->items()->delete();

        return redirect()->route('orders.index')
                         ->with('success', 'Order created!');
    }
}
