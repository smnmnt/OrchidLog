@extends('layouts.layout', ['title' => __('wtr.add_wg')])

@section('content')
    <form action="{{ route('wg.store') }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('parts.name')
        @include('parts.submit')
    </form>
@endsection
