@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => 'Типы обработки'])

@section('content')
        @if(isset($tow) && sizeof($tow))
            <li class="list-group-item mb-5"><a href="{{route('tow.create')}}" class="link-primary">Добавить</a></li>
            <ol class="list-group list-group-numbered">
            @foreach($tow as $Unit)
                    <li class="list-group-item text"><a href="{{ route('tow.show', ['id' => $Unit->ID]) }}">
                            {{nameLimiter($Unit->WateringName)}}
                        </a></li>
            @endforeach
            </ol>
        @else
            <li class="list-group-item">Здесь пусто. <a href="{{route('tow.create')}}" class="link-primary">Добавить</a></li>
        @endif
@endsection
