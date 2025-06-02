@extends('layouts.layout', ['title' => 'Редактирование места'])

@section('content')
    @foreach($placement as $Unit) @endforeach
    <form action="{{ route('placements.update', ['id' => $Unit->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $UnitName   = $Unit->Name;
        @endphp
        @include('parts.name')
        @include('parts.submit')
    </form>
@endsection
