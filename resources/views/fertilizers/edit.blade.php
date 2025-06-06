@extends('layouts.layout', ['title' => __('fert.edit_d')])

@section('content')
    @foreach($fertilizer as $Unit) @endforeach
    <form action="{{ route('fertilizers.update', ['id' => $Unit->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $UnitName   = $Unit->Name;
            $UnitDesc   = $Unit->Desc;
        @endphp
        @include('parts.name')
        @include('parts.desc')
        @include('parts.submit')
    </form>
@endsection
