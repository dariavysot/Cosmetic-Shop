@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Постачальники</h1>

    <a href="{{ route('suppliers.create') }}" class="btn btn-success mb-3">
        Додати постачальника
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Назва</th>
                <th>Телефон</th>
                <th>Email</th>
                <th>Дії</th>
            </tr>
        </thead>

        <tbody>
            @forelse($suppliers as $supplier)
                <tr>
                    <td>{{ $supplier->id }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->phone }}</td>
                    <td>{{ $supplier->email ?? '—' }}</td>

                    <td>
                        <a href="{{ route('suppliers.edit', $supplier->id) }}"
                           class="btn btn-primary btn-sm">Редагувати</a>

                        <form action="{{ route('suppliers.destroy', $supplier->id) }}"
                              method="POST" class="d-inline">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Точно видалити?')">
                                Видалити
                            </button>
                        </form>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="5" class="text-center">Постачальників немає</td>
                </tr>
            @endforelse
        </tbody>

    </table>
</div>
@endsection
