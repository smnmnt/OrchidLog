@extends('layouts.layout', ['title' => 'Добавление недуга'])

@section('content')
    <form action="{{ route('diseases.store') }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('parts.name')
        @include('parts.desc')
        @include('parts.mot')
        @include('parts.submit')
    </form>
@endsection
