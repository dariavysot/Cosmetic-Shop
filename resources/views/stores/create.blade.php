@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Додати склад</h1>

    <form action="{{ route('stores.store') }}" method="POST" class="mt-4">
        @csrf

        <div class="mb-3">
            <label class="form-label">Назва складу</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Адреса (необов'язково)</label>
            <input type="text" name="address" class="form-control">
        </div>

        <button class="btn back-btn">Створити</button>
        <a href="{{ route('stores.index') }}" class="btn btn-minimal">Назад</a>
    </form>
</div>

{{-- Стиль форм та кнопок --}}
<style>
    .form-label {
        font-weight: 500;
    }

    .form-control {
        border: 2px solid #1C1C1C;
        border-radius: 0;
    }

    .form-control:focus {
        border-color: #1C1C1C;
        box-shadow: none;
    }

    /* Мінімалістичний стиль кнопок */
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
</style>
@endsection
