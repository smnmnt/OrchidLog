@extends('layouts.layout', ['title' => 'Редактирование магазина'])

@section('content')
    @foreach($shop as $Unit) @endforeach
    <form action="{{ route('shops.update', ['id' => $Unit->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $UnitName   = $Unit->Name;
            $UnitLink   = $Unit->Link;
        @endphp
        @include('parts.name')
        @include('parts.link')
        @include('parts.submit')
    </form>
@endsection
