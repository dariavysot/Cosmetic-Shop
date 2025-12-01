<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\StoreInventory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            // Адмін бачить усі замовлення
            $orders = Order::with('user', 'items.cosmetic')->get();
        } else {
            // Звичайний користувач бачить лише свої
            $orders = Order::where('user_id', Auth::id())
                ->with('items.cosmetic')
                ->get();
        }

        return view('orders.index', compact('orders'));
    }


    public function create()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->count() === 0) {
            return back()->with('error', 'Ваш кошик порожній.');
        }

        // Перевіряємо наявність товарів
        foreach ($cart->items as $item) {

            $available = StoreInventory::where('cosmetic_id', $item->cosmetic_id)
                ->where('quantity', '>=', $item->quantity)
                ->first();

            if (!$available) {
                return back()->with('error', "Недостатньо товару: {$item->cosmetic->name}");
            }
        }

        // Створюємо замовлення
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => 0,
            'status' => 'pending',
        ]);

        $total = 0;

        // Додаємо позиції та списуємо зі складу
        foreach ($cart->items as $item) {

            $store = StoreInventory::where('cosmetic_id', $item->cosmetic_id)
                ->where('quantity', '>=', $item->quantity)
                ->first();

            OrderItem::create([
                'order_id' => $order->id,
                'cosmetic_id' => $item->cosmetic_id,
                'quantity' => $item->quantity,
                'price' => $item->price_snapshot,
            ]);

            $store->quantity -= $item->quantity;
            $store->save();

            $total += $item->price_snapshot * $item->quantity;
        }

        // Оновлюємо суму
        $order->update(['total_price' => $total]);

        // Очищаємо кошик
        $cart->items()->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Замовлення успішно створено!');
    }

    public function updateStatus(Request $request, Order $order)
    {
        // Перевіряємо роль
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'status' => 'required|string'
        ]);

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Статус замовлення оновлено!');
    }

    public function destroy(Order $order)
    {
        // Адмін може видалити будь-яке замовлення
        // Користувач може видалити ТІЛЬКИ своє
        if (auth()->user()->role !== 'admin' && $order->user_id !== auth()->id()) {
            abort(403);
        }

        // Повертаємо товари на склад ТІЛЬКИ якщо замовлення НЕ completed
        if ($order->status !== 'completed') {
            foreach ($order->items as $item) {
                $inventory = StoreInventory::where('cosmetic_id', $item->cosmetic_id)->first();

                if ($inventory) {
                    $inventory->quantity += $item->quantity;
                    $inventory->save();
                }
            }
        }

        // Видаляємо всі позиції
        $order->items()->delete();

        // Видаляємо саме замовлення
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Замовлення успішно видалено!');
    }
}
