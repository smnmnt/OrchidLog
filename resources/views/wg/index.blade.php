@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => __('wtr.wgs')])

@section('content')
        @if(isset($wg) && sizeof($wg))
            <li class="list-group-item mb-5"><a href="{{route('wg.create')}}" class="link-primary">{{ __('basic.add') }}</a></li>
            <ol class="list-group list-group-numbered">
            @foreach($wg as $Unit)
                    <li class="list-group-item text"><a href="{{ route('wg.show', ['id' => $Unit->ID]) }}">
                            {{$Unit->Name}}
                        </a></li>
            @endforeach
            </ol>
        @else
            <li class="list-group-item">{{ __('basic.nothings_here') }}<a href="{{route('wg.create')}}" class="link-primary">{{ __('basic.add') }}</a></li>
        @endif
@endsection
