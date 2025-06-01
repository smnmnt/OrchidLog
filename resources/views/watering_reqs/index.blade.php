@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => 'Требования к поливу'])

@section('content')
        @if(isset($watering_requirements) && sizeof($watering_requirements))
            <li class="list-group-item mb-5"><a href="{{route('watering_reqs.create')}}" class="link-primary">Добавить</a></li>
            <ol class="list-group list-group-numbered">
            @foreach($watering_requirements as $Unit)
                    <li class="list-group-item text"><a href="{{ route('watering_reqs.show', ['id' => $Unit->ID]) }}">
                            {{nameLimiter($Unit->Name)}}
                        </a></li>
            @endforeach
            </ol>
        @else
            <li class="list-group-item">Здесь пусто. <a href="{{route('watering_reqs.create')}}" class="link-primary">Добавить</a></li>
        @endif
@endsection
