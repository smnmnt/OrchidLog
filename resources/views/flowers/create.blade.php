@extends('layouts.layout', ['title' => __('flower.add_d')])

@section('content')
    <form action="{{ route('flowers.store') }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('parts.flower_name_edit')
        @include('parts.dob')
        @include('parts.size')
        @include('parts.notes')
        @include('parts.shop')
        @include('parts.wrid')
        @include('parts.placement')
        @include('parts.image_input')
        @include('parts.submit')
    </form>
@endsection
