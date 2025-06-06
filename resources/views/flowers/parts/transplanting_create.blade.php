@extends('layouts.layout', ['title' => __('tp.add_d')])

@section('content')
    <form action="{{ route('flowers.transplantings.store', ['id' => $flower->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('flowers.parts.transplantings.type')
        @include('flowers.parts.transplantings.soil')
        @include('flowers.parts.transplantings.SOP')
        @include('flowers.parts.transplantings.date')
        @include('parts.submit')
    </form>
@endsection
