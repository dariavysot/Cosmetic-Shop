@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h2 class="mb-4">Список косметики</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Фільтри -->
    <div class="card mb-4">
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
                    <button class="btn btn-primary w-100">Фільтрувати</button>
                </div>

            </form>
        </div>
    </div>

    @auth
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('cosmetics.create') }}" class="btn btn-success mb-3">➕ Додати косметику</a>
        @endif
    @endauth

    <div class="card">
        <table class="table table-bordered table-striped mb-0">
            <thead class="table-dark">
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
                        <td style="max-width: 300px">{{ $item->description }}</td>
                        <td>{{ $item->price }} грн</td>
                        <td>{{ $item->supplier->name ?? '—' }}</td>

                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <td>
                                <a href="{{ route('cosmetics.edit', $item->id) }}"
                                   class="btn btn-primary btn-sm">Редагувати</a>

                                <form action="{{ route('cosmetics.destroy', $item->id) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Видалити косметику?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Видалити</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
@endsection
