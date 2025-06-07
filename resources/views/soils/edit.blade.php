@extends('layouts.layout', ['title' => __('tp.edit_soil')])

@section('content')
    @foreach($soil as $Unit) @endforeach
    <form action="{{ route('soils.update', ['id' => $Unit->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $UnitName   = $Unit->Name;
        @endphp
        @include('parts.name')
        @include('parts.submit')
    </form>
@endsection
