@extends('layouts.layout', ['title' => 'Главная'])

@section('content')
    asdasd
@endsection

@if(isset($fertilizers) && sizeof($fertilizers))
    @foreach($fertilizers as $fertilizer)
        {{$fertilizer->FertilizerName}}
    @endforeach
@else
    NAnnnn
@endif
