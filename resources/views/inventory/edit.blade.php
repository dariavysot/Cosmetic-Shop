@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Редагувати кількість на складі</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inventory.add') }}" method="POST" class="row g-3">
        @csrf
        <div class="col-md-6">
            <select name="cosmetic_id" class="form-control" required>
                <option value="">Обрати косметику</option>
                @foreach(\App\Models\Cosmetic::all() as $cosmetic)
                    <option value="{{ $cosmetic->id }}">{{ $cosmetic->name }} ({{ $cosmetic->quantity }} шт.)</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <input type="number" name="quantity" class="form-control" min="1" placeholder="Додати кількість" required>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Додати</button>
        </div>
    </form>
</div>
@endsection
