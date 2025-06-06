@extends('layouts.layout', ['title' =>  __('wtr.add_d') ])

@section('content')
    <form action="{{ route('flowers.waterings.store', ['id' => $flower->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @csrf
        @include('flowers.parts.waterings.type')
        @include('flowers.parts.waterings.fertilizer')
        @include('flowers.parts.waterings.doze')
        @include('flowers.parts.waterings.date')
        @include('parts.submit')
    </form>
@endsection
