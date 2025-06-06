@extends('layouts.layout', ['title' => __('wtr.edit_wg')])

@section('content')
    @foreach($wg as $Unit) @endforeach
    <form action="{{ route('wg.update', ['id' => $Unit->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $UnitName   = $Unit->Name;
        @endphp
        @include('parts.name')
        @include('parts.submit')
    </form>
@endsection
