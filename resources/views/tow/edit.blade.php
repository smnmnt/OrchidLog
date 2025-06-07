@extends('layouts.layout', ['title' => __('wtr.edit_type')])

@section('content')
    @foreach($tow as $Unit) @endforeach
    <form action="{{ route('tow.update', ['id' => $Unit->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $UnitName   = $Unit->WateringName;
            $UnitIcon   = $Unit->TypeOfImg;
        @endphp
        @include('parts.name')
        @include('tow.parts.icon')

        @include('parts.submit')
    </form>
@endsection
