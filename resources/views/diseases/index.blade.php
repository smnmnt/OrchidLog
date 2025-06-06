@include('parts.nameLimiter')

@extends('layouts.layout', ['title' =>  __('disease.ds')])

@section('content')
    @if(isset($diseases) && sizeof($diseases))
        <li class="list-group-item mb-5"><a href="{{route('diseases.create')}}" class="link-primary">{{  __('basic.add') }}</a></li>
        <ol class="list-group list-group-numbered">
            @foreach($diseases as $Unit)
                <li class="list-group-item text"><a href="{{ route('diseases.show', ['id' => $Unit->ID]) }}">
                        {{$Unit->Name}}
                    </a></li>
            @endforeach
        </ol>
    @else
        <li class="list-group-item">{{  __('nothings_here') }}<a href="{{route('diseases.create')}}" class="link-primary">{{  __('basic.add') }}</a></li>
    @endif
@endsection
