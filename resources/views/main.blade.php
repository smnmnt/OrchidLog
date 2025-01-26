@extends('layouts.layout', ['title' => 'Главная'])

@section('content')
{{--    asdasd--}}
<a href="{{ route('flowers.show', ['id' => 1]) }}">ssadasdas</a>
@endsection
{{--@if(isset($fertilizers) && sizeof($fertilizers))--}}
{{--    @foreach($fertilizers as $fertilizer)--}}
{{--        {{$fertilizer->FertilizerName}}--}}
{{--    @endforeach--}}
{{--@else--}}
{{--    NAnnnn--}}
{{--@endif--}}
