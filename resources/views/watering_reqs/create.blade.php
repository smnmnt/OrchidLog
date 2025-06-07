@extends('layouts.layout', ['title' => __('wtr.add_wr')])

@section('content')
    <form action="{{ route('watering_reqs.store') }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('parts.name')
        @include('parts.submit')
    </form>
@endsection
