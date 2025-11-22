@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Постачальники</h1>

    <a href="{{ route('suppliers.create') }}" class="btn btn-success btn-minimal mb-3">
        Додати постачальника
    </a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card custom-card">
        <div class="card-body p-0">
            <table class="table custom-table mb-0">
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
                                class="btn btn-edit btn-sm btn-minimal">Редагувати</a>

                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-delete btn-sm btn-minimal"
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
    </div>

</div>

<style>
    .custom-card {
        border: 2px solid #1C1C1C;
        border-radius: 0;
    }

    /* Товсті рамки таблиці */
    .custom-table th, .custom-table td {
        border: 1.5px solid #1C1C1C !important;
    }

     /* Базовий мінімалістичний стиль для кнопок */
    .btn-minimal {
        border-radius: 0;
        font-weight: 500;
        padding: 6px 12px;
        transition: all 0.3s ease;
        border: 2px solid #1C1C1C;
        background-color: #fff;
        color: #1C1C1C;
    }

    /* Ховер для базових кнопок */
    .btn-minimal:hover {
        background-color: #1C1C1C;
        color: #fff;
        border-color: #1C1C1C;
    }

    /* Кнопка "Додати"/позитивна дія */
    .btn-add {
        border-color: #28a745;
        color: #28a745;
    }
    .btn-add:hover {
        background-color: #28a745;
        color: #fff;
        border-color: #28a745;
    }

    /* Кнопка "Редагувати"/попередження */
    .btn-edit {
        border-color: #ffc107;
        color: #856404;
    }
    .btn-edit:hover {
        background-color: #ffc107;
        color: #1C1C1C;
        border-color: #ffc107;
    }

    /* Кнопка "Видалити"/негативна дія */
    .btn-delete {
        border-color: #dc3545;
        color: #dc3545;
    }
    .btn-delete:hover {
        background-color: #dc3545;
        color: #fff;
        border-color: #dc3545;
    }

    /* Маленькі кнопки */
    .btn-sm {
        padding: 3px 8px;
        font-size: 0.85rem;
    }
</style>
@endsection
