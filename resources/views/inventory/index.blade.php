@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Інвентар всіх складів</h1>

    <a href="{{ route('inventory.addForm') }}" class="btn btn-success mb-3">Додати товар на склад</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Склад</th>
                <th>Товар</th>
                <th>SKU</th>
                <th>Кількість</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventory as $item)
                <tr>
                    <td>{{ $item->store->name }}</td>
                    <td>{{ $item->cosmetic->name }}</td>
                    <td>{{ $item->cosmetic->sku ?? '-' }}</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
