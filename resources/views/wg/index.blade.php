@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => 'Группы обработки'])

@section('content')
        @if(isset($wg) && sizeof($wg))
            <li class="list-group-item mb-5"><a href="{{route('wg.create')}}" class="link-primary">Добавить</a></li>
            <ol class="list-group list-group-numbered">
            @foreach($wg as $Unit)
                    <li class="list-group-item text"><a href="{{ route('wg.show', ['id' => $Unit->ID]) }}">
                            {{nameLimiter($Unit->Name)}}
                        </a></li>
            @endforeach
            </ol>
        @else
            <li class="list-group-item">Здесь пусто. <a href="{{route('wg.create')}}" class="link-primary">Добавить</a></li>
        @endif
@endsection
