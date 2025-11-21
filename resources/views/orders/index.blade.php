@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>{{ auth()->user()->role === 'admin' ? 'Усі замовлення' : 'Мої замовлення' }}</h2>

    @foreach ($orders as $order)
        <div class="card custom-card mb-3 shadow-sm">
            <div class="card-body">

                <h5>Замовлення №{{ $order->id }}</h5>
                <p>Статус: <strong>{{ $order->status }}</strong></p>
                <p>Сума: <strong>{{ number_format($order->total_price, 2) }} ₴</strong></p>

                @if(auth()->user()->role === 'admin')
                    <p>Користувач: <strong>{{ $order->user->name }}</strong></p>
                @endif

                <hr>

                <ul>
                    @foreach ($order->items as $item)
                        <li>
                            {{ $item->cosmetic->name }}
                            ({{ $item->quantity }} шт × {{ $item->price }} ₴)
                        </li>
                    @endforeach
                </ul>

                @if(auth()->user()->role === 'admin')
                    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="mt-2 d-flex align-items-center">
                        @csrf

                        <select name="status" class="form-select w-auto me-2">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Очікує</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>В обробці</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Завершено</option>
                        </select>

                        <button type="submit" class="btn order-btn btn-sm">
                            Оновити
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>

{{-- Стилі --}}
<style>

    .custom-card {
        
        border-radius: 0;
    }
    .order-btn {
        background-color: #1C1C1C;
        color: #fff;
        border: 1.5px solid #1C1C1C;
        border-radius: 0;
        padding: 5px 15px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .order-btn:hover {
        background-color: #fff;
        color: #1C1C1C;
        border-color: #1C1C1C;
    }
</style>
@endsection
