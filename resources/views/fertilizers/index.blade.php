@extends('layouts.layout', ['title' => 'Удобрения'])

@section('content')
        @if(isset($fertilizers) && sizeof($fertilizers))
            <li class="list-group-item mb-5"><a href="{{route('fertilizers.create')}}" class="link-primary">Добавить</a></li>
            <ol class="list-group list-group-numbered">
            @foreach($fertilizers as $fertilizer)
                    <li class="list-group-item fs-2 text"><a href="{{ route('fertilizers.show', ['id' => $fertilizer->FertilizerID]) }}">
                            @if(mb_strlen($fertilizer->FertilizerName)>10)
                                {{mb_substr($fertilizer->FertilizerName, 0 , 10)}}...
                            @else
                                {{$fertilizer->FertilizerName}}
                            @endif
                        </a></li>
            @endforeach
            </ol>
        @else
            <li class="list-group-item">Здесь пусто. <a href="{{route('fertilizers.create')}}" class="link-primary">Добавить</a></li>
        @endif
@endsection
