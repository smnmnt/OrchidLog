@extends('layouts.layout', ['title' => 'Редактирование требований к поливу'])

@section('content')
    @foreach($watering_requirement as $Unit) @endforeach
    <form action="{{ route('watering_reqs.update', ['id' => $Unit->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $UnitName   = $Unit->Name;
        @endphp
        @include('parts.name')
        @include('parts.submit')
    </form>
@endsection
