@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Додати товар на склад</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('inventory.add') }}" method="POST" class="mt-4">
        @csrf

        <div class="mb-3">
            <label class="form-label">Склад</label>
            <select name="store_id" class="form-control" required>
                <option value="">Виберіть склад</option>
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Косметика</label>
            <select name="cosmetic_id" class="form-control" required>
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

        <button class="btn btn-primary">Додати</button>
        <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection
