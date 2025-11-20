@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Профіль</h1>

    <div class="card p-4">
        <p><strong>Ім'я:</strong> {{ auth()->user()->name }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p><strong>Телефон:</strong> {{ auth()->user()->phone ?? '—' }}</p>
        <p><strong>Роль:</strong> {{ auth()->user()->role }}</p>
    </div>
</div>
@endsection
