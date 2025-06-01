@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => 'Места'])

@section('content')
        @if(isset($placements) && sizeof($placements))
            <li class="list-group-item mb-5"><a href="{{route('placements.create')}}" class="link-primary">Добавить</a></li>
            <ol class="list-group list-group-numbered">
            @foreach($placements as $Unit)
                    <li class="list-group-item text"><a href="{{ route('placements.show', ['id' => $Unit->ID]) }}">
                            {{nameLimiter($Unit->Name)}}
                        </a></li>
            @endforeach
            </ol>
        @else
            <li class="list-group-item">Здесь пусто. <a href="{{route('placements.create')}}" class="link-primary">Добавить</a></li>
        @endif
@endsection
