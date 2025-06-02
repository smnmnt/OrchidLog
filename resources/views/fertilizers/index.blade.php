@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => 'Удобрения'])

@section('content')
        @if(isset($fertilizers) && sizeof($fertilizers))
            <li class="list-group-item mb-5"><a href="{{route('fertilizers.create')}}" class="link-primary">Добавить</a></li>
            <ol class="list-group list-group-numbered">
            @foreach($fertilizers as $Unit)
                    <li class="list-group-item text"><a href="{{ route('fertilizers.show', ['id' => $Unit->ID]) }}">
                            {{nameLimiter($Unit->Name)}}
                        </a></li>
            @endforeach
            </ol>
        @else
            <li class="list-group-item">Здесь пусто. <a href="{{route('fertilizers.create')}}" class="link-primary">Добавить</a></li>
        @endif
@endsection
