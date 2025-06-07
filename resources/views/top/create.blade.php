@extends('layouts.layout', ['title' => __('tp.add_top')])

@section('content')
    <form action="{{ route('top.store') }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('parts.name')
        @include('parts.submit')
    </form>
@endsection
