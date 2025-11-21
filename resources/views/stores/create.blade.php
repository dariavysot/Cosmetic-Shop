@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Додати склад</h1>

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

        <button class="btn btn-success">Створити</button>
        <a href="{{ route('stores.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection
