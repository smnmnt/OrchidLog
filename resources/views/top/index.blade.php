@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => 'Типы посадки'])

@section('content')
        @if(isset($top) && sizeof($top))
            <li class="list-group-item mb-5"><a href="{{route('top.create')}}" class="link-primary">Добавить</a></li>
            <ol class="list-group list-group-numbered">
            @foreach($top as $Unit)
                    <li class="list-group-item text"><a href="{{ route('top.show', ['id' => $Unit->ID]) }}">
                            {{nameLimiter($Unit->Name)}}
                        </a></li>
            @endforeach
            </ol>
        @else
            <li class="list-group-item">Здесь пусто. <a href="{{route('top.create')}}" class="link-primary">Добавить</a></li>
        @endif
@endsection
