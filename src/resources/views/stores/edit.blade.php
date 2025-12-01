@extends('layouts.app')

@section('content')

<style>
    .inventory-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 25px 30px;
        background: #fff;
        border: 1.5px solid #1C1C1C;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .inventory-title {
        text-align: center;
        margin-bottom: 25px;
        font-weight: 600;
        letter-spacing: 0.5px;
        color: #1C1C1C;
    }

    .form-label {
        font-weight: 500;
        color: #1C1C1C;
    }

    .form-control {
        border: 2px solid #1C1C1C;
        border-radius: 0;
        height: 40px;
    }

    .btn-save {
        width: 100%;
        border: 2px solid #1C1C1C;
        background: #fff;
        color: #1C1C1C;
        border-radius: 0;
        padding: 10px;
        font-weight: 500;
        transition: 0.25s ease-in-out;
    }
    .btn-save:hover {
        background: #1C1C1C;
        color: #fff;
    }

    .inventory-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 25px;
    }
    .inventory-table th, .inventory-table td {
        border: 1.5px solid #1C1C1C;
        padding: 8px 12px;
        text-align: left;
    }
    .inventory-table th {
        background: #f8f8f8;
    }

    .btn-edit, .btn-delete {
        border-radius: 0;
        font-weight: 500;
        padding: 5px 12px;
        transition: 0.3s ease;
    }
    .btn-edit {
        border: 2px solid #ffc107;
        color: #856404;
        background: #fff;
    }
    .btn-edit:hover {
        background: #ffc107;
        color: #1C1C1C;
    }
    .btn-delete {
        border: 2px solid #dc3545;
        color: #dc3545;
        background: #fff;
    }
    .btn-delete:hover {
        background: #dc3545;
        color: #fff;
    }
</style>

<div class="inventory-container">

    <h2 class="inventory-title">Редагування складу: {{ $store->name }}</h2>

    {{-- Форма редагування складу --}}
    <form action="{{ route('stores.update', $store->id) }}" method="POST" class="mb-4">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Назва складу</label>
            <input type="text" name="name" class="form-control" value="{{ $store->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Адреса</label>
            <input type="text" name="address" class="form-control" value="{{ $store->address }}">
        </div>

        <button type="submit" class="btn-save">Зберегти зміни</button>
    </form>

</div>

@endsection
