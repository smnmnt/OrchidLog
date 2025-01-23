@extends('layouts.layout', ['title' => 'Редактирование удобрения'])

@section('content')
    @foreach($fertilizer as $Fertilizer_un) @endforeach
    <form action="{{ route('fertilizers.update', ['id' => $Fertilizer_un->FertilizerID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @include('fertilizers.parts.form')
    </form>
@endsection
