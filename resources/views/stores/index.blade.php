@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Склади</h1>

    <a href="{{ route('stores.create') }}" class="btn mb-3 btn-minimal">Додати склад</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table custom-table table-bordered align-middle">
        <thead>
            <tr>
                <th>Назва</th>
                <th>Адреса</th>
                <th>Інвентар</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stores as $store)
                <tr>
                    <td>{{ $store->name }}</td>
                    <td>{{ $store->address }}</td>
                    <td>
                        <a href="{{ route('stores.inventory', $store) }}" class="btn btn-minimal btn-sm">Переглянути</a>
                    </td>
                    <td>
                       <a href="{{ route('stores.edit', $store) }}" class="btn btn-edit btn-sm btn-minimal">Редагувати</a>
                        <form action="{{ route('stores.destroy', $store) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-delete btn-sm btn-minimal">Видалити</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    /* Товсті рамки таблиці */
    .custom-table th, .custom-table td {
        border: 2px solid #1C1C1C !important;
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
