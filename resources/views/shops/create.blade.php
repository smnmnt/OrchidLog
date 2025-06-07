@extends('layouts.layout', ['title' => __('flower.add_shop')])

@section('content')
    <form action="{{ route('shops.store') }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('parts.name')
        @include('parts.link')
        @include('parts.submit')
    </form>
@endsection
