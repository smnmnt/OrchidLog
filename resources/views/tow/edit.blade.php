@extends('layouts.layout', ['title' => 'Редактирование типа обработки'])

@section('content')
    @foreach($tow as $Unit) @endforeach
    <form action="{{ route('tow.update', ['id' => $Unit->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $UnitName   = $Unit->WateringName;
        @endphp
        @include('parts.name')
        @if(isset($Unit->TypeOfImg))
            <div class="album">
                <div class="album_el">
                    <div class="card card_gallery_item shadow-sm pop" style="background-image: url({{$Unit->TypeOfImg}}); background-size:cover;">
                        <div class="card-body">
                            <img src="{{$Unit->TypeOfImg}}" alt="{{ $Unit->Name }}" style="display: none;">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @include('parts.image_input')
        @include('parts.submit')
    </form>
@endsection
