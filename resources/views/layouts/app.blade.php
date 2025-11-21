<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cosmetic Shop</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
        }
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #343a40;
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar a {
            color: #ddd;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
        }
        .sidebar a:hover {
            background: #495057;
            color: #fff;
        }
        .content {
            margin-left: 260px;
            padding: 30px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h4 class="text-center mb-4">Cosmetic Shop</h4>

    <a href="{{ route('home') }}">📖 Каталог</a>

    @auth

        {{-- КОШИК И ЗАМОВЛЕННЯ — ЛИШЕ ДЛЯ КОРИСТУВАЧІВ --}}
        @if(auth()->user()->role !== 'admin')
            <a href="{{ route('cart.index') }}">🛒 Кошик</a>
            <a href="{{ route('orders.index') }}">📦 Мої замовлення</a>
        @endif

        {{-- АДМІН МЕНЮ --}}
        @if(auth()->user()->role === 'admin')
            <hr class="text-white">
            <a href="{{ route('cosmetics.index') }}">🛠 Управління косметикою</a>
            <a href="{{ route('suppliers.index') }}">🚚 Постачальники</a>
            <a href="{{ route('stores.index') }}">🏬 Склади</a>
            <a href="{{ route('inventory.index') }}">📦 Залишки</a>
            <a href="{{ route('inventory.editForm') }}">✏️ Редагувати кількість</a>
            <a href="{{ route('orders.index') }}">📋 Всі замовлення</a>
            
        @endif

        <hr class="text-white">

        <a href="{{ route('profile') }}">👤 Профіль</a>

        {{-- LOGOUT --}}
        <a href="#" onclick="document.getElementById('logout-form').submit();">🚪 Вийти</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

    @endauth


    @guest
        <a href="{{ route('login') }}">🔑 Увійти</a>
        <a href="{{ route('register') }}">📝 Реєстрація</a>
    @endguest
</div>

<!-- Content -->
<div class="content">
    @yield('content')
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
