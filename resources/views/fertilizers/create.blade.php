@extends('layouts.layout', ['title' => __('fert.add_d')])

@section('content')
    <form action="{{ route('fertilizers.store') }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('parts.name')
        @include('parts.desc')
        @include('parts.submit')
    </form>
@endsection
