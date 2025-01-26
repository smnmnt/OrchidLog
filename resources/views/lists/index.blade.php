@extends('layouts.layout', ['title' => 'Обзор'])

@section('content')
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('fertilizers.index') }}" class="adding-list-link">Удобрения</a>
            <span class="badge bg-primary rounded-pill">{{sizeof($fertilizers)}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('soils.index') }}" class="adding-list-link">Почвы</a>
            <span class="badge bg-primary rounded-pill">{{sizeof($soils)}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('diseases.index') }}" class="adding-list-link">Недуги</a>
            <span class="badge bg-primary rounded-pill">{{sizeof($diseases)}}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('placements.index') }}" class="adding-list-link">Места</a>
            <span class="badge bg-primary rounded-pill">{{sizeof($placements)}}</span>
        </li>

    </ul>
@endsection
