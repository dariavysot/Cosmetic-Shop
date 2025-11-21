@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Редагувати косметику</h2>
        <a href="{{ route('cosmetics.index') }}" class="btn btn-secondary">Назад</a>
    </div>

    <div class="card">
        <div class="card-body">

            <form action="{{ route('cosmetics.update', $cosmetic->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Назва</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ $cosmetic->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">SKU</label>
                    <input type="text" name="sku" class="form-control"
                           value="{{ $cosmetic->sku }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Опис</label>
                    <textarea name="description" class="form-control"
                              rows="3">{{ $cosmetic->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ціна (грн)</label>
                    <input type="number" name="price" step="0.01" min="0"
                           class="form-control"
                           value="{{ $cosmetic->price }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Постачальник</label>
                    <select name="supplier_id" class="form-select">
                        <option value="">Не вибрано</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}"
                                @selected($cosmetic->supplier_id == $supplier->id)>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary">Оновити</button>

            </form>

        </div>
    </div>

</div>
@endsection
