@extends('layouts.layout', ['title' => __('basic.adding')])

@section('content')
            <div class="list-group">
                {{--        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">--}}
                {{--            The current link item--}}
                {{--        </a>--}}
                <a href="{{ route('fertilizers.create') }}" class="list-group-item list-group-item-action">Удобрения</a>
                <a href="{{ route('soils.create') }}" class="list-group-item list-group-item-action">Почвы</a>
                <a href="{{ route('diseases.create') }}" class="list-group-item list-group-item-action">Недуги</a>
                {{--        <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>--}}
                {{--        <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">A disabled link item</a>--}}
            </div>
@endsection
