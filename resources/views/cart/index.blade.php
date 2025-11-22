@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Ваш кошик</h2>

    {{-- Повідомлення --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($items->count() == 0)
        <div class="alert alert-info">
            Ваш кошик порожній. <a href="{{ route('home') }}">Переглянути косметику</a>
        </div>
    @else

    <div class="card custom-card">
        <div class="card-body">

            <table class="table custom-table align-middle">
                <thead>
                    <tr>
                        <th>Товар</th>
                        <th width="120">Ціна</th>
                        <th width="160">Кількість</th>
                        <th width="120">Разом</th>
                        <th width="80"></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->cosmetic->name }}</strong><br>
                                <small class="text-muted">{{ $item->cosmetic->brand ?? '' }}</small>
                            </td>

                            <td>{{ number_format($item->price_snapshot, 2) }} ₴</td>

                            <td>
                                {{-- Форма зміни кількості --}}
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                                    @csrf
                                    <input type="number"
                                           name="quantity"
                                           min="1"
                                           value="{{ $item->quantity }}"
                                           class="form-control form-control-sm text-center">
                                    <button class="btn btn-success btn-sm ms-2">✔</button>
                                </form>
                            </td>

                            <td>
                                {{ number_format($item->quantity * $item->price_snapshot, 2) }} ₴
                            </td>

                            <td>
                                {{-- Видалення --}}
                                <form action="{{ route('cart.delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Видалити товар?')">🗑</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

            <div class="text-end mt-4">
                <h4>Всього: <strong>{{ number_format($total, 2) }} ₴</strong></h4>

                <form action="{{ route('orders.create') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn order-btn mt-3">
                        Оформити замовлення
                    </button>
                </form>
            </div>

        </div>
    </div>

    @endif

</div>

{{-- Стилі --}}
<style>
    /* Товсті рамки таблиці */
    .custom-table th, .custom-table td {
        border: 1.5px solid #1C1C1C !important;
    }

    /* Карта зі схожою товщиною рамки */
    .custom-card {
        border: 1.5px solid #1C1C1C;
        border-radius: 0;
    }

    /* Кнопка оформлення замовлення */
    .order-btn {
        background-color: #fff;
        color: #1C1C1C;
        border: 1.5px solid #1C1C1C;
        border-radius: 0;
        padding: 8px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .order-btn:hover {
        background-color: #1C1C1C;
        color: #fff;
        border-color: #1C1C1C;
    }
</style>

@endsection
