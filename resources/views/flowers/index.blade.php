@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => 'Растения'])

@section('content')
    @if(isset($flowers) && sizeof($flowers))
        <li class="list-group-item mb-5"><a href="{{route('flowers.create')}}" class="link-primary">Добавить</a></li>
        <ol class="list-group list-group-numbered">
            @foreach($flowers as $Unit)
                <a href="{{route('flowers.show', ['id' => $Unit->ID])}}">
                    <div class="card">
{{--                        <img src="{{ $Unit->ImageLink }}" class="card-img-top" alt="{{nameLimiter($Unit->Name)}}">--}}
                        <div class="card-body">
                            <h5 class="card-title">{{-- $loop->iteration --}} {{ $loop->iteration." ".$Unit->Name}}</h5>
                        </div>
                    </div>
                </a>
            @endforeach
        </ol>
    @else
        <li class="list-group-item">Здесь пусто. <a href="{{route('flowers.create')}}" class="link-primary">Добавить</a></li>
    @endif
@endsection
