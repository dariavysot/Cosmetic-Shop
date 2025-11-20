@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Реєстрація</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register.perform') }}">
        @csrf

        <div class="mb-3">
            <label>Ім'я:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label>Телефон:</label>
            <input type="text" name="phone" class="form-control" 
                value="{{ old('phone') }}"
                placeholder="+380XXXXXXXXX"
                required>
            <small class="text-muted">Формат: +380 та 9 цифр (наприклад +380931234567)</small>
        </div>


        <div class="mb-3">
            <label>Пароль:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Підтвердження пароля:</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button class="btn btn-success">Створити акаунт</button>
    </form>
</div>
@endsection

<script>
document.querySelector('input[name="phone"]').addEventListener('input', function(e) {
    let v = e.target.value.replace(/\D/g, ''); // тільки цифри
    if (!v.startsWith("380")) {
        v = "380" + v;
    }
    v = "+" + v.substring(0, 12); // +380XXXXXXXXX
    e.target.value = v;
});
</script>
