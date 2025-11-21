@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4 fw-bold text-center">Каталог косметики</h2>

    <div class="row g-4">

        @forelse ($cosmetics as $cosmetic)
            <div class="col-md-4 col-sm-6">
                <div class="card border-0 shadow-sm rounded-4 h-100">

                    @if($cosmetic->image)
                        <img src="{{ asset('storage/' . $cosmetic->image) }}" 
                             class="card-img-top rounded-top-4" 
                             alt="{{ $cosmetic->name }}" 
                             style="height: 250px; object-fit: cover;">
                    @endif

                    <div class="card-body text-center">

                        <h5 class="fw-semibold">{{ $cosmetic->name }}</h5>

                        <p class="text-muted small">
                            {{ Str::limit($cosmetic->description, 60) }}
                        </p>

                        <h4 class="text-primary fw-bold mb-3">
                            {{ number_format($cosmetic->price, 2) }} ₴
                        </h4>

                      @auth
                        @if(auth()->user()->role !== 'admin')
                            <form action="{{ route('cart.add') }}" method="POST" class="d-flex justify-content-center mt-3">
                                @csrf
                                <input type="hidden" name="cosmetic_id" value="{{ $cosmetic->id }}">
                                <button class="btn btn-success rounded-pill px-4">
                                    Додати в кошик
                                </button>
                            </form>
                        @endif
                    @endauth
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">Поки що косметики немає.</p>
        @endforelse

    </div>
</div>

@endsection
