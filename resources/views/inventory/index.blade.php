@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Інвентар всіх складів</h1>

    <div class="mb-3">
        <a href="{{ route('inventory.addForm') }}" class="btn order-btn">
            Додати товар на склад
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card custom-card">
        <div class="card-body p-0">
            <table class="table custom-table mb-0">
                <thead>
                    <tr>
                        <th>Склад</th>
                        <th>Товар</th>
                        <th>SKU</th>
                        <th>Кількість</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($inventory as $item)
                        <tr>
                            <td>{{ $item->store->name }}</td>
                            <td>{{ $item->cosmetic->name }}</td>
                            <td>{{ $item->cosmetic->sku ?? '-' }}</td>
                            <td>{{ $item->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Стилі --}}
<style>
    /* Карта обгортка */
    .custom-card {
        border: 2px solid #1C1C1C;
        border-radius: 0;
    }

    /* Товсті рамки таблиці */
    .custom-table th, .custom-table td {
        border: 1.5px solid #1C1C1C !important;
    }

    /* Стиль кнопки */
    .order-btn {
        background-color: #fff;
        color: #1C1C1C;
        border: 2px solid #1C1C1C;
        border-radius: 0;
        padding: 6px 20px;
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
