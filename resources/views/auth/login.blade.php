@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Вхід</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.perform') }}">
        @csrf

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Пароль:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary">Увійти</button>

        <p class="mt-3">
            Немає акаунта? <a href="{{ route('register') }}">Зареєструватися</a>
        </p>
    </form>
</div>
@endsection
