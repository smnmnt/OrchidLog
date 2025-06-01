@extends('layouts.layout', ['title' => 'Добавление типа обработки'])

@section('content')
    <form action="{{ route('tow.store') }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('parts.name')
        @include('parts.image_input')
        @include('parts.submit')
    </form>
@endsection
