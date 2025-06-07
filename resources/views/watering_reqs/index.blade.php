@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => __('wtr.wrs')])

@section('content')
        @if(isset($watering_requirements) && sizeof($watering_requirements))
            <li class="list-group-item mb-5"><a href="{{route('watering_reqs.create')}}" class="link-primary">{{ __('basic.add') }}</a></li>
            <ol class="list-group list-group-numbered">
            @foreach($watering_requirements as $Unit)
                    <li class="list-group-item text"><a href="{{ route('watering_reqs.show', ['id' => $Unit->ID]) }}">
                            {{$Unit->Name}}
                        </a></li>
            @endforeach
            </ol>
        @else
            <li class="list-group-item">{{ __('basic.nothings_here') }}<a href="{{route('watering_reqs.create')}}" class="link-primary">{{ __('basic.add') }}</a></li>
        @endif
@endsection
