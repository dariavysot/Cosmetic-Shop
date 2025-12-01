@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Редагувати кількість на складі</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('inventory.updateQuantity') }}" method="POST" class="row g-3">
        @csrf

        <div class="col-md-4">
            <label class="form-label">Склад</label>
            <select name="store_id" class="form-control" required>
                <option value="">Оберіть склад</option>
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Косметика</label>
            <select name="cosmetic_id" class="form-control" required>
                <option value="">Оберіть косметику</option>
                @foreach($cosmetics as $cosmetic)
                    <option value="{{ $cosmetic->id }}">{{ $cosmetic->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <label class="form-label">Кількість</label>
            <input type="number" name="quantity" class="form-control" min="1" value="1" required>
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button class="btn order-btn w-100">Додати</button>
        </div>
    </form>
</div>

{{-- Стиль кнопки та полів у мінімалістичному вигляді --}}
<style>
    .form-label {
        font-weight: 500;
    }

    .form-control, .form-select {
        border: 2px solid #1C1C1C;
        border-radius: 0;
    }

    .form-control:focus, .form-select:focus {
        border-color: #1C1C1C;
        box-shadow: none;
    }

    .order-btn {
        background-color: #fff;
        color: #1C1C1C;
        border: 2px solid #1C1C1C;
        border-radius: 0;
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
