@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => __('fert.d')])

@section('content')
        @if(isset($fertilizers) && sizeof($fertilizers))
            <li class="list-group-item mb-5"><a href="{{route('fertilizers.create')}}" class="link-primary">{{ __('basic.add') }}</a></li>
            <ol class="list-group list-group-numbered">
            @foreach($fertilizers as $Unit)
                    <li class="list-group-item text"><a href="{{ route('fertilizers.show', ['id' => $Unit->ID]) }}">
                            {{nameLimiter($Unit->Name)}}
                        </a></li>
            @endforeach
            </ol>
        @else
            <li class="list-group-item">{{ __('basic.nothings_here') }}<a href="{{route('fertilizers.create')}}" class="link-primary">{{ __('basic.add') }}</a></li>
        @endif
@endsection
