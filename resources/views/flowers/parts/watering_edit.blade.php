@extends('layouts.layout', ['title' => 'Редактирование обработки'])

@section('content')
    <form action="{{ route('flowers.waterings.update', ['id' => $watering->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $FertilizerDoze     = $watering->FertilizerDoze;
            $WateringDate       = $watering->WateringDate;
        @endphp
        @include('flowers.parts.waterings.type')
        @include('flowers.parts.waterings.fertilizer')
        @include('flowers.parts.waterings.doze')
        @include('flowers.parts.waterings.date')
        @include('parts.submit')
    </form>
@endsection
