@extends('layouts.layout', ['title' => 'Редактирова недуга'])

@section('content')
    <form action="{{ route('flowers.diseases.store', ['id' => $flower->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('flowers.parts.diseases.disease')
        @include('parts.submit')
    </form>
@endsection
