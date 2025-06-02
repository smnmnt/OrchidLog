@extends('layouts.layout', ['title' => 'Редактирование недуга'])

@section('content')
    @foreach($disease as $Unit) @endforeach
    <form action="{{ route('diseases.update', ['id' => $Unit->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $UnitName   = $Unit->Name;
            $UnitDesc   = $Unit->Desc;
            $UnitMOT    = $Unit->MOT;
        @endphp
        @include('parts.name')
        @include('parts.desc')
        @include('parts.mot')
        @include('parts.submit')
    </form>
@endsection
