@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Редагувати постачальника</h1>

    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Назва постачальника:</label>
            <input type="text" name="name" class="form-control"
                   value="{{ $supplier->name }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Телефон:</label>
            <input type="text" name="phone" class="form-control"
                   value="{{ $supplier->phone }}">
            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control"
                   value="{{ $supplier->email }}">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-primary">Оновити</button>
        <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection
