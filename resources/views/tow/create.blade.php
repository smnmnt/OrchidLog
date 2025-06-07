@extends('layouts.layout', ['title' => __('wtr.add_type')])

@section('content')
    <form action="{{ route('tow.store') }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('parts.name')
        @include('tow.parts.icon')
        @include('parts.submit')
    </form>
@endsection
