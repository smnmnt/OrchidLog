@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => __('wtr.n_d_ds')])

@section('content')
        @if(isset($tow) && sizeof($tow))
            <li class="list-group-item mb-5"><a href="{{route('tow.create')}}" class="link-primary">{{ __('basic.add') }}</a></li>
            <ol class="list-group list-group-numbered">
            @foreach($tow as $Unit)
                    <li class="list-group-item text"><a href="{{ route('tow.show', ['id' => $Unit->ID]) }}">
                            {{$Unit->WateringName}}<span>   {{$Unit->TypeOfImg}}</span>
                        </a></li>
            @endforeach
            </ol>
        @else
            <li class="list-group-item">{{ __('basic.nothings_here') }}<a href="{{route('tow.create')}}" class="link-primary">{{ __('basic.add') }}</a></li>
        @endif
@endsection
