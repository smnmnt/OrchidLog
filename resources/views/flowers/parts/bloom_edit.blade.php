@extends('layouts.layout', ['title' => __('wtr.edit_d')])

@section('content')
    <form action="{{ route('flowers.blooms.update', ['id' => $bloom->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $BloomBB    = $bloom->BB;
            $BloomBE    = $bloom->BE;
            $Peduncle   = $bloom->peduncle;
        @endphp
        @include('flowers.parts.blooms.BB')
        @include('flowers.parts.blooms.BE')
		@include('flowers.parts.blooms.peduncle')
        @include('parts.submit')
    </form>
@endsection
