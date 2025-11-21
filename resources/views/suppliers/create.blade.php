@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Додати постачальника</h1>

    <form action="{{ route('suppliers.store') }}" method="POST" class="mt-3">
        @csrf

        <div class="mb-3">
            <label>Назва постачальника:</label>
            <input type="text" name="name" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Телефон (формат +380…):</label>
            <input type="text" name="phone" class="form-control">
            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-success">Створити</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection
