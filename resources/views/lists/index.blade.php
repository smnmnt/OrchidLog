@extends('layouts.layout', ['title' => 'Обзор'])

@section('content')
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('fertilizers.index') }}" class="adding-list-link">Удобрения</a>
            <span class="badge bg-primary rounded-pill">{{sizeof($fertilizers)}}</span>
        </li>

    </ul>
@endsection
