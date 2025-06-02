@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => 'Недуги'])

@section('content')
    @if(isset($diseases) && sizeof($diseases))
        <li class="list-group-item mb-5"><a href="{{route('diseases.create')}}" class="link-primary">Добавить</a></li>
        <ol class="list-group list-group-numbered">
            @foreach($diseases as $Unit)
                <li class="list-group-item text"><a href="{{ route('diseases.show', ['id' => $Unit->ID]) }}">
                        {{nameLimiter($Unit->Name)}}
                    </a></li>
            @endforeach
        </ol>
    @else
        <li class="list-group-item">Здесь пусто. <a href="{{route('diseases.create')}}" class="link-primary">Добавить</a></li>
    @endif
@endsection
