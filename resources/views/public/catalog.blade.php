@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4">Каталог косметики</h2>

    <div class="row">

        @forelse ($cosmetics as $cosmetic)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">

                    <div class="card-body">
                        <h5 class="card-title">{{ $cosmetic->name }}</h5>

                        <p class="text-muted">
                            Постачальник: 
                            <strong>{{ $cosmetic->supplier->name ?? 'Невідомий' }}</strong>
                        </p>

                        <p>{{ Str::limit($cosmetic->description, 80) }}</p>

                        <h4 class="text-primary">{{ number_format($cosmetic->price, 2) }} ₴</h4>

                        @auth
                            <form action="{{ route('cart.add') }}" method="POST" class="mt-3 d-flex">
                                @csrf
                                <input type="hidden" name="cosmetic_id" value="{{ $cosmetic->id }}">
                                <input type="number" name="quantity" value="1" min="1" class="form-control w-25 me-2">
                                <button class="btn btn-success">Додати в кошик</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary mt-3">
                                Додати в кошик
                            </a>
                        @endauth

                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Поки що косметики немає.</p>
        @endforelse

    </div>
</div>

@endsection
