@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Додати постачальника</h1>

    <div class="card custom-card p-4">
        <form action="{{ route('suppliers.store') }}" method="POST" class="mt-3">
            @csrf

            <div class="mb-3">
                <label class="form-label">Назва постачальника:</label>
                <input type="text" name="name" class="form-control" required>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Телефон (формат +380…):</label>
                <input type="text" name="phone" class="form-control">
                @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control">
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success back-btn">Створити</button>
                <a href="{{ route('suppliers.index') }}" class="btn btn-minimal">Назад</a>
            </div>
        </form>
    </div>
</div>

{{-- Стиль форм та кнопок --}}
<style>
     .custom-card {
        border: 2px solid #1C1C1C;
        border-radius: 0;
    }

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
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .back-btn:hover {
        background-color: #fff;
        color: #1C1C1C;
        border-color: #1C1C1C;
    }
</style>
@endsection
