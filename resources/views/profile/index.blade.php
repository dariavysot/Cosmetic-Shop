@extends('layouts.app')

@section('content')

<style>
    .profile-container {
        max-width: 480px;
        margin: 60px auto;
        padding: 35px 40px;
        background: #fff;
        border: 1.5px solid #1C1C1C;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .profile-title {
        text-align: center;
        margin-bottom: 25px;
        font-weight: 600;
        letter-spacing: 0.5px;
        color: #1C1C1C;
    }

    .profile-item {
        padding: 12px 0;
        border-bottom: 1px solid #e0e0e0;
        font-size: 15px;
    }

    .profile-item:last-child {
        border-bottom: none;
    }

    .profile-label {
        font-weight: 500;
        color: #1C1C1C;
    }

    .profile-value {
        margin-left: 6px;
        color: #333;
    }
</style>

<div class="profile-container">

    <h2 class="profile-title">Профіль</h2>

    <div class="profile-item">
        <span class="profile-label">Ім'я:</span>
        <span class="profile-value">{{ auth()->user()->name }}</span>
    </div>

    <div class="profile-item">
        <span class="profile-label">Email:</span>
        <span class="profile-value">{{ auth()->user()->email }}</span>
    </div>

    <div class="profile-item">
        <span class="profile-label">Телефон:</span>
        <span class="profile-value">{{ auth()->user()->phone ?? '—' }}</span>
    </div>

    <div class="profile-item">
        <span class="profile-label">Роль:</span>
        <span class="profile-value">{{ auth()->user()->role }}</span>
    </div>

</div>

@endsection
