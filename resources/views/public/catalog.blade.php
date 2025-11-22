@extends('layouts.app')

@section('content')

<!-- Підключаємо Bootstrap Icons через CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    /* Заголовок */
    .catalog-title {
        text-align: center;
        font-weight: 600;
        margin-bottom: 30px;
        color: #1C1C1C;
        letter-spacing: 0.5px;
    }

    /* Пошук */
    .search-input {
        border: 2px solid #1C1C1C !important;
        border-radius: 0 !important;
        height: 40px;
        padding-left: 12px;
    }

    .search-btn {
        border: 2px solid #1C1C1C;
        border-radius: 0;
        background: #fff;
        padding: 0 16px;
        transition: .3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .search-btn:hover {
        background: #1C1C1C;
        color: white;
    }

    .search-btn i {
        font-size: 18px;
    }

    /* Картка продукту */
    .product-card {
        border: 2px solid #1C1C1C;
        border-radius: 0;
        height: 400px;
        display: flex;
        flex-direction: column;
        background: #fff;
        transition: 0.25s ease;
    }

    .product-img {
        width: 100%;
        height: 200px; /* однакова висота */
        border-bottom: 2px solid #1C1C1C;
        background: #efefef;
        border-radius: 0;
        overflow: hidden;
    }

    .product-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .placeholder {
        width: 100%;
        height: 100%;
        background: #f3f3f3;
        color: #777;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .product-body {
        flex: 1;
        padding: 14px 16px;
        display: flex;
        flex-direction: column;
    }

    .product-title {
        font-weight: 600;
        font-size: 18px;
        margin-bottom: 4px;
    }

    .product-desc {
        font-size: 13px;
        color: #555;
        margin-bottom: auto;
        margin-top: 5px;
    }

    .price {
        margin-top: 10px;
        font-weight: bold;
        font-size: 18px;
        color: #1C1C1C;
    }

    /* Мінімалістична кнопка */
    .btn-add {
        width: 100%;
        margin-top: 12px;
        border: 2px solid #1C1C1C;
        border-radius: 0;
        padding: 7px 0;
        background: #fff;
        color: #1C1C1C;
        font-weight: 500;
        transition: .3s ease;
    }

    .btn-add:hover {
        background: #1C1C1C;
        color: #fff;
    }
</style>


<div class="container mt-4">

    <h2 class="catalog-title">Каталог косметики</h2>

    {{-- ПОШУК --}}
    <form method="GET" 
          action="{{ route('home') }}" 
          class="mb-4 d-flex justify-content-center">

        <div class="input-group" style="max-width: 600px;">

            <input type="text"
                name="search"
                class="form-control search-input"
                placeholder="Пошук за назвою..."
                value="{{ request('search') }}">

            <button class="btn search-btn">
                <i class="bi bi-search"></i>
            </button>

        </div>
    </form>


    <div class="row g-4">

        @forelse ($cosmetics as $cosmetic)
            <div class="col-md-4 col-lg-3">
                <div class="product-card">
                    <div class="product-img">
                        @if($cosmetic->image ?? false)
                            <img src="{{ asset('storage/' . $cosmetic->image) }}" alt="">
                        @else
                            <div class="placeholder">Фото</div>
                        @endif
                    </div>

                    <div class="product-body">

                        <h5 class="product-title">{{ $cosmetic->name }}</h5>

                        <div class="product-desc">
                            {{ Str::limit($cosmetic->description, 70) }}
                        </div>

                        <div class="price">
                            {{ number_format($cosmetic->price, 2) }} ₴
                        </div>

                        @auth
                            @if(auth()->user()->role !== 'admin')
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="cosmetic_id" value="{{ $cosmetic->id }}">
                                    <button class="btn-add">
                                        Додати в кошик
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn-add">
                                Увійти щоб купувати
                            </a>
                        @endauth

                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Поки що товарів немає.</p>
        @endforelse

    </div>
</div>

@endsection
