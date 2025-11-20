<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Магазин косметики</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}">Cosmetic Shop</a>

        <div>
            <ul class="navbar-nav ms-auto">
                @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Вхід</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Реєстрація</a></li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}">Профіль</a></li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-link nav-link">Вихід</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </div>

    </div>
</nav>

<main>
    @yield('content')
</main>

</body>
</html>
