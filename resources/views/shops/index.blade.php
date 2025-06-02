@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => 'Магазины'])

@section('content')
        @if(isset($shops) && sizeof($shops))
            <li class="list-group-item mb-5"><a href="{{route('shops.create')}}" class="link-primary">Добавить</a></li>
            <ol class="list-group list-group-numbered">
            @foreach($shops as $Unit)
                    <li class="list-group-item text"><a href="{{ route('shops.show', ['id' => $Unit->ID]) }}">
                            {{nameLimiter($Unit->Name)}}
                        </a></li>
            @endforeach
            </ol>
        @else
            <li class="list-group-item">Здесь пусто. <a href="{{route('shops.create')}}" class="link-primary">Добавить</a></li>
        @endif
@endsection
