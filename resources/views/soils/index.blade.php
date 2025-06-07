@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => __('tp.s_ds')])

@section('content')
    @if(isset($soils) && sizeof($soils))
        <li class="list-group-item mb-5"><a href="{{route('soils.create')}}" class="link-primary">{{ __('basic.add') }}</a></li>
        <ol class="list-group list-group-numbered">
            @foreach($soils as $Unit)
                <li class="list-group-item text"><a href="{{ route('soils.show', ['id' => $Unit->ID]) }}">
                        {{$Unit->Name}}
                    </a></li>
            @endforeach
        </ol>
    @else
        <li class="list-group-item">{{ __('basic.nothings_here') }}<a href="{{route('soils.create')}}" class="link-primary">{{ __('basic.add') }}</a></li>
    @endif
@endsection
