@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => __('flower.plcs')])

@section('content')
        @if(isset($placements) && sizeof($placements))
            <li class="list-group-item mb-5"><a href="{{route('placements.create')}}" class="link-primary">{{ __('basic.add') }}</a></li>
            <ol class="list-group list-group-numbered">
            @foreach($placements as $Unit)
                    <li class="list-group-item text"><a href="{{ route('placements.show', ['id' => $Unit->ID]) }}">
                            {{$Unit->Name}}
                        </a></li>
            @endforeach
            </ol>
        @else
            <li class="list-group-item">{{ __('basic.nothings_here') }}<a href="{{route('placements.create')}}" class="link-primary">{{ __('basic.add') }}</a></li>
        @endif
@endsection
