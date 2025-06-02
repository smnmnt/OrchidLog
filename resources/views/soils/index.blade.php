@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => 'Почвы'])

@section('content')
    @if(isset($soils) && sizeof($soils))
        <li class="list-group-item mb-5"><a href="{{route('soils.create')}}" class="link-primary">Добавить</a></li>
        <ol class="list-group list-group-numbered">
            @foreach($soils as $Unit)
                <li class="list-group-item text"><a href="{{ route('soils.show', ['id' => $Unit->ID]) }}">
                        {{nameLimiter($Unit->Name)}}
                    </a></li>
            @endforeach
        </ol>
    @else
        <li class="list-group-item">Здесь пусто. <a href="{{route('soils.create')}}" class="link-primary">Добавить</a></li>
    @endif
@endsection
