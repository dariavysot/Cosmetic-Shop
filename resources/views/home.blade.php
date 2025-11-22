@extends('layouts.app')

@section('content')
<div class="container mt-5">

    <div class="p-4 bg-light rounded-3 shadow-sm">
        <h1 class="display-4">Магазин косметики</h1>
        <p class="lead">Ласкаво просимо! Тут ви можете переглядати товари без реєстрації або входу.</p>

        @guest
            <a href="{{ route('login') }}" class="btn btn-primary mt-3">Увійти</a>
            <a href="{{ route('register') }}" class="btn btn-outline-primary mt-3">Зареєструватися</a>
        @else
            <a href="{{ route('profile') }}" class="btn btn-success mt-3">Перейти в профіль</a>
        @endguest
    </div>

</div>
@endsection
