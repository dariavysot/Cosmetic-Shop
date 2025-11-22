@extends('layouts.app')

@section('content')

<style>
    .auth-container {
        max-width: 420px;
        margin: 60px auto;
        padding: 35px 40px;
        background: #fff;
        border: 1.5px solid #1C1C1C;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .auth-title {
        text-align: center;
        margin-bottom: 25px;
        font-weight: 600;
        letter-spacing: 0.5px;
        color: #1C1C1C;
    }

    .auth-input {
        border: 1.5px solid #1C1C1C !important;
        border-radius: 0 !important;
        height: 40px;
    }

    .auth-btn {
        width: 100%;
        border: 1.5px solid #1C1C1C;
        background: white;
        color: #1C1C1C;
        border-radius: 0;
        padding: 10px;
        font-weight: 500;
        transition: 0.25s ease-in-out;
    }

    .auth-btn:hover {
        background: #1C1C1C;
        color: white;
    }

    .auth-link {
        text-align: center;
        margin-top: 18px;
        font-size: 14px;
    }

    .alert-danger {
        border-radius: 0;
    }
</style>

<div class="auth-container">

    <h2 class="auth-title">Вхід</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login.perform') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" 
                   value="{{ old('email') }}" 
                   class="form-control auth-input" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Пароль:</label>
            <input type="password" name="password" 
                   class="form-control auth-input" required>
        </div>

        <button class="auth-btn">Увійти</button>

        <p class="auth-link">
            Немає акаунта? 
            <a href="{{ route('register') }}">Зареєструватися</a>
        </p>
    </form>
</div>

@endsection
