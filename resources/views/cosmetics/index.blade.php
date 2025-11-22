@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">

    <h2 class="mb-4 text-center">Список косметики</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Фільтри -->
    <div class="card mb-4 p-2 filter-wrapper">
        <div class="card-body">
            <form method="GET" class="row g-3">

                <div class="col-md-4">
                    <input type="text" name="name" class="form-control" 
                           value="{{ request('name') }}" placeholder="Пошук за назвою...">
                </div>

                <div class="col-md-4">
                    <select name="supplier_id" class="form-select">
                        <option value="">Обрати постачальника</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}"
                                @selected(request('supplier_id') == $supplier->id)>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <button type="submit" class="btn btn-minimal w-100">Фільтрувати</button>
                </div>

            </form>
        </div>
    </div>

    @auth
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('cosmetics.create') }}" class="btn btn-minimal mb-3"> Додати косметику</a>
        @endif
    @endauth


    <div class="card custom-card">
        <div class="card-body p-0">
            <table class="table custom-table mb-0">
                <tr>
                    <th>Назва</th>
                    <th>SKU</th>
                    <th>Опис</th>
                    <th>Ціна</th>
                    <th>Постачальник</th>
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <th>Дії</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @foreach($cosmetics as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->sku ?? '-' }}</td>
                        <td style="max-width: 300px; word-wrap: break-word;">{{ $item->description }}</td>
                        <td>{{ number_format($item->price, 2) }} грн</td>
                        <td>{{ $item->supplier->name ?? '—' }}</td>

                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <td>
                                <a href="{{ route('cosmetics.edit', $item->id) }}"
                                   class="btn btn-edit btn-sm me-1">Редагувати</a>

                                <form action="{{ route('cosmetics.destroy', $item->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Видалити косметику?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-delete btn-sm">Видалити</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        
        </table>
    </div>

</div>

{{-- Стилі --}}
<style>
    /* Таблиця */
     .custom-card {
        border: 2px solid #1C1C1C;
        border-radius: 0;
    }

    /* Товсті рамки таблиці */
    .custom-table th, .custom-table td {
        border: 1.5px solid #1C1C1C !important;
    }

     .filter-wrapper {
        border: 2px solid #1C1C1C;
        border-radius: 0;
        display: flex;
        flex-wrap: wrap;
        gap: 0;
    }

    /* Інпут/селект для фільтрів */
    .form-control, .form-select {
        border: 2px solid #1C1C1C;
        border-radius: 0;
        padding: 6px 10px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #1C1C1C;
        box-shadow: none;
    }

    /* Базовий мінімалістичний стиль кнопок */
    .btn-minimal {
        border-radius: 0;
        font-weight: 500;
        padding: 6px 12px;
        transition: all 0.3s ease;
        border: 2px solid #1C1C1C;
        background-color: #fff;
        color: #1C1C1C;
    }
    .btn-minimal:hover {
        background-color: #1C1C1C;
        color: #fff;
        border-color: #1C1C1C;
    }

    /* Додати/позитив */
    .btn-add {
        border-color: #28a745;
        color: #28a745;
        border-radius: 0;
        font-weight: 500;
        padding: 6px 12px;
        transition: all 0.3s ease;
        background-color: #fff;
    }
    .btn-add:hover {
        background-color: #28a745;
        color: #fff;
        border-color: #28a745;
    }

    /* Редагувати/попередження */
    .btn-edit {
        border-color: #ffc107;
        border: 2px solid #ffc107;
        color: #856404;
        border-radius: 0;
        font-weight: 500;
        padding: 6px 12px;
        transition: all 0.3s ease;
        background-color: #fff;
    }
    .btn-edit:hover {
        background-color: #ffc107;
        color: #1C1C1C;
        border-color: #ffc107;
    }

    /* Видалити/негатив */
    .btn-delete {
        border-color: #dc3545;
        border: 2px solid #dc3545;
        color: #dc3545;
        border-radius: 0;
        font-weight: 500;
        padding: 6px 12px;
        transition: all 0.3s ease;
        background-color: #fff;
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
