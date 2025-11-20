@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Косметика</h1>

    @auth
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('cosmetics.create') }}" class="btn btn-success mb-3">Додати косметику</a>
        @endif
    @endauth

    <form method="GET" class="mb-3">
        <div class="row">
            <div class="col">
                <input type="text" name="name" value="{{ request('name') }}" class="form-control" placeholder="Назва косметики">
            </div>
            <div class="col">
                <select name="supplier_id" class="form-select">
                    <option value="">Всі постачальники</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" @if(request('supplier_id') == $supplier->id) selected @endif>{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <button class="btn btn-primary">Фільтрувати</button>
            </div>
        </div>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Назва</th>
                <th>Ціна</th>
                <th>Постачальник</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cosmetics as $cosmetic)
                <tr>
                    <td>{{ $cosmetic->id }}</td>
                    <td>{{ $cosmetic->name }}</td>
                    <td>{{ $cosmetic->price }}</td>
                    <td>{{ $cosmetic->supplier->name ?? '—' }}</td>
                    <td>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('cosmetics.edit', $cosmetic->id) }}" class="btn btn-primary btn-sm">Редагувати</a>

                                <form action="{{ route('cosmetics.destroy', $cosmetic->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Точно видалити?')">Видалити</button>
                                </form>
                            @endif
                        @endauth
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">Косметики немає</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
