@extends('layouts.layout', ['title' => 'Добавление удобрения'])

@section('content')
    <form action="{{ route('fertilizers.store') }}" method="post" class="form-box" enctype="multipart/form-data">
        @include('fertilizers.parts.form')
    </form>
@endsection
