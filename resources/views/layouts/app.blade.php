<!doctype html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cosmetic Shop</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f5f5f5;
            color: #1C1C1C;
            font-family: "Inter", sans-serif;
        }

        /* === SIDEBAR === */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #ffffff;
            border-right: 2px solid #1C1C1C;
            position: fixed;
            top: 0;
            left: 0;
            padding: 25px 0;
        }

        .sidebar h4 {
            font-weight: 700;
            margin-bottom: 25px;
            color: #1C1C1C;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            text-align: center;
        }

        .sidebar a {
            color: #1C1C1C;
            text-decoration: none;
            padding: 12px 22px;
            display: flex;
            align-items: center;
            border-top: 2px solid #1C1C1C;
            transition: 0.25s ease;
            font-weight: 500;
        }

        .sidebar a:last-child {
            border-bottom: 2px solid #1C1C1C;
        }

        .sidebar a:hover {
            background: #1C1C1C;
            color: white;
        }

        .sidebar a i {
            margin-right: 12px;
            font-size: 18px;
            width: 20px;
            text-align: center;
        }

        .sidebar hr {
            border-color: #1C1C1C;
            opacity: 1;
            border-width: 2px;
            margin: 12px 0;
        }

        /* === CONTENT === */
        .content {
            margin-left: 260px;
            padding: 35px;
        }

        /* === GLOBAL BUTTONS === */
        .btn-primary,
        .btn-success,
        .btn-outline-primary {
            border-radius: 0 !important;
            border: 2px solid #1C1C1C !important;
            background: white !important;
            color: #1C1C1C !important;
            font-weight: 500 !important;
            transition: 0.25s ease;
        }

        .btn-primary:hover,
        .btn-success:hover,
        .btn-outline-primary:hover {
            background: #1C1C1C !important;
            color: white !important;
        }

        input.form-control, select.form-select, textarea.form-control {
            border-radius: 0 !important;
            border: 2px solid #1C1C1C !important;
            box-shadow: none !important;
        }

        input.form-control:focus, select.form-select:focus {
            border-color: #1C1C1C !important;
            box-shadow: none !important;
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h4>Cosmetic Shop</h4>

    <a href="{{ route('home') }}"><i class="bi bi-book"></i>Каталог</a>

    @auth
        @if(auth()->user()->role !== 'admin')
            <a href="{{ route('cart.index') }}"><i class="bi bi-cart"></i>Кошик</a>
            <a href="{{ route('orders.index') }}"><i class="bi bi-box-seam"></i>Мої замовлення</a>
        @endif

        @if(auth()->user()->role === 'admin')
            <hr>
            <a href="{{ route('cosmetics.index') }}"><i class="bi bi-tools"></i>Управління косметикою</a>
            <a href="{{ route('suppliers.index') }}"><i class="bi bi-truck"></i>Постачальники</a>
            <a href="{{ route('stores.index') }}"><i class="bi bi-shop"></i>Склади</a>
            <a href="{{ route('inventory.index') }}"><i class="bi bi-box"></i>Залишки</a>
            <a href="{{ route('inventory.editForm') }}"><i class="bi bi-pencil-square"></i>Редагувати кількість</a>
            <a href="{{ route('orders.index') }}"><i class="bi bi-card-checklist"></i>Всі замовлення</a>
        @endif

        <hr>

        <a href="{{ route('profile') }}"><i class="bi bi-person"></i>Профіль</a>
        <a href="#" onclick="document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right"></i>Вийти</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
    @endauth

    @guest
        <a href="{{ route('login') }}"><i class="bi bi-key"></i>Увійти</a>
        <a href="{{ route('register') }}"><i class="bi bi-pencil"></i>Реєстрація</a>
    @endguest
</div>

<!-- CONTENT -->
<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
