@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Склади</h1>

    <a href="{{ route('stores.create') }}" class="btn btn-primary mb-3">Додати склад</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
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
                        <a href="{{ route('stores.inventory', $store) }}" class="btn btn-info btn-sm">
                            Переглянути
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('stores.edit', $store) }}" class="btn btn-warning btn-sm">Редагувати</a>

                        <form action="{{ route('stores.destroy', $store) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Видалити склад?')">

                            @csrf
                            @method('DELETE')

                            <button class="btn btn-danger btn-sm">Видалити</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
