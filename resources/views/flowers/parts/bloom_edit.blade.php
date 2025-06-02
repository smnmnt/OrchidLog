@extends('layouts.layout', ['title' => 'Редактирование цветения'])

@section('content')
    <form action="{{ route('flowers.blooms.update', ['id' => $bloom->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $BloomBB    = $bloom->BB;
            $BloomBE    = $bloom->BE;
        @endphp
        @include('flowers.parts.blooms.BB')
        @include('flowers.parts.blooms.BE')
        @include('parts.submit')
    </form>
@endsection
