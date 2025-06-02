@extends('layouts.layout', ['title' => 'Добавление почвы'])

@section('content')
    <form action="{{ route('soils.store') }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('parts.name')
        @include('parts.submit')
    </form>
@endsection
