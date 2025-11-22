@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Інвентар складу: {{ $store->name }}</h1>

    <a href="{{ route('stores.index') }}" class="btn btn-minimal btn-sm mb-3">Назад</a>

    <table class="table custom-table table-striped">
        <thead>
            <tr>
                <th>Товар</th>
                <th>SKU</th>
                <th>Кількість</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr>
                    <td>{{ $item->cosmetic->name }}</td>
                    <td>{{ $item->cosmetic->sku ?? '-' }}</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Немає товарів на складі</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Стилі --}}
<style>
    /* Таблиця з товстими рамками */
    .custom-table th, .custom-table td {
        border: 2px solid #1C1C1C !important;
    }

    /* Базовий мінімалістичний стиль кнопок */
    .btn-minimal {
        border-radius: 0;
        font-weight: 500;
        padding: 6px 12px;
        transition: all 0.3s ease;
        border: 2px solid #1C1C1C;
        background-color: #fff;
        color: #1C1C1C;
    }

    .btn-minimal:hover {
        background-color: #1C1C1C;
        color: #fff;
        border-color: #1C1C1C;
    }

</style>
@endsection
