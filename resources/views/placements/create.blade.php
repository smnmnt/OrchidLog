@extends('layouts.layout', ['title' => 'Добавление места'])

@section('content')
    <form action="{{ route('placements.store') }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('parts.name')
        @include('parts.submit')
    </form>
@endsection
