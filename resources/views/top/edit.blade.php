@extends('layouts.layout', ['title' => __('tp.edit_top')])

@section('content')
    @foreach($top as $Unit) @endforeach
    <form action="{{ route('top.update', ['id' => $Unit->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $UnitName   = $Unit->Name;
        @endphp
        @include('parts.name')
        @include('parts.submit')
    </form>
@endsection
