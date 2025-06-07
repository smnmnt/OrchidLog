@extends('layouts.layout', ['title' => __('flower.add_plc') ])

@section('content')
    <form action="{{ route('placements.store') }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('parts.name')
        @include('parts.submit')
    </form>
@endsection
