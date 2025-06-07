@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => __('tp.t_ds')])

@section('content')
        @if(isset($top) && sizeof($top))
            <li class="list-group-item mb-5"><a href="{{route('top.create')}}" class="link-primary">{{ __('basic.add') }}</a></li>
            <ol class="list-group list-group-numbered">
            @foreach($top as $Unit)
                    <li class="list-group-item text"><a href="{{ route('top.show', ['id' => $Unit->ID]) }}">
                            {{$Unit->Name}}
                        </a></li>
            @endforeach
            </ol>
        @else
            <li class="list-group-item">{{ __('basic.nothings_here') }}<a href="{{route('top.create')}}" class="link-primary">{{ __('basic.add') }}</a></li>
        @endif
@endsection
