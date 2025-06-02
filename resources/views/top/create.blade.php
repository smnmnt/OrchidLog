@extends('layouts.layout', ['title' => 'Добавление типа посадки'])

@section('content')
    <form action="{{ route('top.store') }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('parts.name')
        @include('parts.submit')
    </form>
@endsection
