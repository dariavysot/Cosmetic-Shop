@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Редагувати косметику</h1>

    <form action="{{ route('cosmetics.update', $cosmetic->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Назва:</label>
            <input type="text" name="name" class="form-control" value="{{ $cosmetic->name }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Ціна:</label>
            <input type="number" name="price" class="form-control" step="0.01" value="{{ $cosmetic->price }}">
            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Постачальник:</label>
            <select name="supplier_id" class="form-select">
                <option value="">Не вибрано</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" @if($cosmetic->supplier_id == $supplier->id) selected @endif>{{ $supplier->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Оновити</button>
        <a href="{{ route('cosmetics.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection
