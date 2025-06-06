@extends('layouts.layout', ['title' => __('tp.edit_d')])

@section('content')
    <form action="{{ route('flowers.transplantings.update', ['id' => $transplanting->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $SOP        = $transplanting->SOP;
            $DOT        = $transplanting->DOT;
        @endphp
        @include('flowers.parts.transplantings.type')
        @include('flowers.parts.transplantings.soil')
        @include('flowers.parts.transplantings.SOP')
        @include('flowers.parts.transplantings.date')
{{--        @foreach($old_soils_ids->all() as $a)--}}
{{--            <br>{{$a}}<br>--}}
{{--        @endforeach--}}
        @include('parts.submit')
    </form>
@endsection
