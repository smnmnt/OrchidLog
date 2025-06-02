@extends('layouts.layout', ['title' => 'Добавление цветения'])

@section('content')
    <form action="{{ route('flowers.blooms.store', ['id' => $flower->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('flowers.parts.blooms.BB')
        @include('flowers.parts.blooms.BE')
        @include('parts.submit')
    </form>
@endsection
