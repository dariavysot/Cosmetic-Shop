@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h1 class="mb-4 text-center">Додати товар на склад</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card custom-card p-4">
        <form action="{{ route('inventory.add') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Склад</label>
                <select name="store_id" class="form-select" required>
                    <option value="">Виберіть склад</option>
                    @foreach($stores as $store)
                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Косметика</label>
                <select name="cosmetic_id" class="form-select" required>
                    <option value="">Виберіть товар</option>
                    @foreach($cosmetics as $cosmetic)
                        <option value="{{ $cosmetic->id }}">{{ $cosmetic->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Кількість</label>
                <input type="number" name="quantity" class="form-control" min="1" value="1" required>
            </div>

           <div class="d-flex gap-2">
                <button type="submit" class="btn back-btn">Додати</button>
                <a href="{{ route('inventory.index') }}" class="btn order-btn">Назад</a>
            </div>
        </form>
    </div>

</div>

{{-- Стилі --}}
<style>
    .custom-card {
        border: 2px solid #1C1C1C;
        border-radius: 0;
    }

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
    .back-btn {
        background-color: #1C1C1C;
        color: #fff;
        border: 2px solid #1C1C1C;
        border-radius: 0;
        padding: 6px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        background-color: #fff;
        color: #1C1C1C;
        border-color: #1C1C1C;
    }

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
</style>

@endsection
