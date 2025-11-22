@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Додати косметику 2 злишки додати</h2>
    </div>


        
            <form action="{{ route('cosmetics.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Назва</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">SKU</label>
                    <input type="text" name="sku" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Опис</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ціна (грн)</label>
                    <input type="number" name="price" step="0.01" min="0" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Постачальник</label>
                    <select name="supplier_id" class="form-select">
                        <option value="">Не вибрано</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-success back-btn">Створити</button>
                <a href="{{ route('cosmetics.index') }}" class="btn btn-minimal">Назад</a>

            </form>
        

</div>

{{-- Стилі для форм і кнопок --}}
<style>
    .form-label {
        font-weight: 500;
    }

    .form-control, .form-select {
        border: 2px solid #1C1C1C;
        border-radius: 0;
        padding: 6px 10px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #1C1C1C;
        box-shadow: none;
    }

     .filter-wrapper {
        border: 2px solid #1C1C1C;
        border-radius: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 0;
    }

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
