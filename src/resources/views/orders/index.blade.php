@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">

    <h2 class="mb-4 text-center">
        {{ auth()->user()->role === 'admin' ? 'Усі замовлення' : 'Мої замовлення' }}
    </h2>

    @foreach ($orders as $order)
        <div class="card custom-card mb-4">
            <div class="card-body">

                <div class="d-flex justify-content-between">
                    <h5 class="fw-bold">Замовлення №{{ $order->id }}</h5>
                    <span class="order-status px-2 py-1">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <p class="mt-3">Сума: 
                    <strong>{{ number_format($order->total_price, 2) }} ₴</strong>
                </p>

                @if(auth()->user()->role === 'admin')
                    <p>Користувач: <strong>{{ $order->user->name }}</strong></p>
                @endif

                <hr class="order-divider">

                <ul class="order-list">
                    @foreach ($order->items as $item)
                        <li>
                            {{ $item->cosmetic->name }}
                            ({{ $item->quantity }} шт × {{ $item->price }} ₴)
                        </li>
                    @endforeach
                </ul>

               <div class="d-flex align-items-center mt-3">
                    @if(auth()->user()->role === 'admin')
                        <form action="{{ route('orders.updateStatus', $order->id) }}" 
                            method="POST" 
                            class="d-flex align-items-center me-2">

                            @csrf

                            <select name="status" class="form-select status-select me-2">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Очікує</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>В обробці</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Завершено</option>
                            </select>

                            <button type="submit" class="btn btn-minimal btn-sm w-auto px-3">
                                Оновити
                            </button>
                        </form>
                    @endif

                    @if(auth()->user()->role === 'admin' || auth()->id() === $order->user_id)
                        <form action="{{ route('orders.destroy', $order->id) }}"
                            method="POST">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-delete btn-sm"
                                    onclick="return confirm('Видалити це замовлення?')">
                                Видалити
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- Стилі --}}
<style>

    /* Карточка замовлення */
    .custom-card {
        border: 2px solid #1C1C1C;
        border-radius: 0;
        padding: 10px;
    }

    .order-divider {
        border-top: 2px solid #1C1C1C;
    }

    /* Статус */
    .order-status {
        border: 2px solid #1C1C1C;
        border-radius: 0;
        font-weight: 500;
        background: #fff;
    }

    /* Список товарів */
    .order-list li {
        padding: 4px 0;
        list-style: square;
    }

    /* Селект статусу */
    .status-select {
        border: 2px solid #1C1C1C;
        border-radius: 0;
        padding: 5px 10px;
        width: 160px;
    }
    .status-select:focus {
        box-shadow: none;
        border-color: #1C1C1C;
    }

    /* Мінімалістична кнопка */
    .btn-minimal {
        border-radius: 0;
        font-weight: 500;
        padding: 6px 12px;
        transition: 0.3s ease;
        border: 2px solid #1C1C1C;
        background-color: #fff;
        color: #1C1C1C;
    }
    .btn-minimal:hover {
        background-color: #1C1C1C;
        color: white;
    }

    .btn-delete {
        border: 2px solid #A30000;
        background: #fff;
        color: #A30000;
        border-radius: 0;
        padding: 6px 12px;
        transition: .3s ease;
        font-weight: 500;
    }

    .btn-delete:hover {
        background: #A30000;
        color: #fff;
    }


</style>
@endsection
