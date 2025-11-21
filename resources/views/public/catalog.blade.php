@extends('layouts.app')

@section('content')

<style>
    .product-card {
        border: none;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        height: 380px; /* фіксована висота картки */
        display: flex;
        flex-direction: column;
    }

    .catalog-title {
        text-align: center;
        font-weight: 600;
        margin-bottom: 30px;
        letter-spacing: 0.5px;
        color: #1C1C1C;
    }

    .search-input {
        border: 1.5px solid #1C1C1C !important;
        border-radius: 0 !important;
        height: 36px;
        font-size: 14px;
        padding-left: 12px;
    }

    .custom-btn {
        background: white;
        border: 1.5px solid #1C1C1C;
        border-radius: 0;
        color: #1C1C1C;
        transition: 0.2s;
    }

    .custom-btn:hover {
        color: white;
        border: 1.5px solid #1C1C1C;
    }

    .product-img {
        height: 160px;
        background: #f3f3f3;
        border-bottom: 1px solid #eee;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        color: #bbb;
    }

    .product-body {
        flex: 1; /* дозволяє тексту розтягувати простір */
        padding: 14px 18px;
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
        color: #666;
        margin-bottom: 10px;
        flex-grow: 1; /* займає вільний простір, щоб кнопка була знизу */
    }

    .price {
        font-size: 20px;
        font-weight: bold;
        color:  #1C1C1C;
        margin-bottom: 12px;
    }

    .btn-add {
        width: 100%;
        padding: 10px;
        font-weight: 500;
        margin-top: auto;

        background-color: #ffffff;          /* білий фон */
        color: #1C1C1C;                     /* графітовий текст */
        border: 1.5px solid #1C1C1C;          /* графітова рамка */

        border-radius: 0;                   /* без закруглень */
        transition: 0.25s ease-in-out;      /* плавний ховер */
    }

</style>

<div class="container mt-4">

    <h2 class="catalog-title">Каталог косметики</h2>

     {{-- ПОШУК --}}
    <form method="GET" action="{{ route('home') }}" 
      class="mb-4 d-flex justify-content-center">

        <div style="width: 600px;" class="input-group">

            <input 
                type="text" 
                name="search" 
                class="form-control search-input"
                placeholder="Пошук за назвою..."
                value="{{ request('search') }}"
            >

            <button class="btn custom-btn"><img width="19.5" height="19.5" src="https://img.icons8.com/ios/50/search--v1.png" alt="search--v1"/></button>

        </div>
    </form>


    <div class="row g-4">

        @forelse ($cosmetics as $cosmetic)
            <div class="col-md-4 col-lg-3">
                <div class="product-card">

                    <div class="product-img">
                        Фото
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
                                    <button class="btn btn-add">
                                        Додати в кошик
                                    </button>

                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-add">
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
