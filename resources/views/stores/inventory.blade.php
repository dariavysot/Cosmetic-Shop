@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Інвентар складу: {{ $store->name }}</h1>

    <a href="{{ route('stores.index') }}" class="btn btn-secondary mb-3">Назад</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Товар</th>
                <th>SKU</th>
                <th>Кількість</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
                <tr>
                    <td>{{ $item->cosmetic->name }}</td>
                    <td>{{ $item->cosmetic->sku }}</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Немає товарів на складі</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
