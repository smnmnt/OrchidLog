@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => 'Просмотр'])

@section('content')
    @foreach($tow as $Unit)
        <div class="card">
            <div class="card-body">
                <fieldset disabled>
                    @php
                        $UnitName   = $Unit->WateringName;
                    @endphp
                    @include('parts.name')
                </fieldset>
                <div class="album">
                    <div class="album_el">
                        <div class="card card_gallery_item shadow-sm pop" style="background-image: url({{$Unit->TypeOfImg}}); background-size:cover;">
                            <div class="card-body">
                                <img src="{{$Unit->TypeOfImg}}" alt="{{ $Unit->Name }}" style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>
            <div class="card-body d-flex justify-content-around">
                <a href="{{ route('tow.edit', ['id' => $Unit->ID]) }}" class=" btn edit_btn">
                    <img src="{{ '/storage/img/pencil.svg' }}" alt="edit">
                </a>
                <form action="{{ route('tow.destroy', ['id' => $Unit->ID]) }}"
                      class="delete-btn"
                      method="post"
                      onsubmit="return confirm('Удалить тип обработки *{{$Unit->Name}}*? Будут удалены ВСЕ обработки использующие этот тип! (Растения не удалятся.)');">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn standart-btn" aria-label="Close" style="background-image: url({{ asset('/storage/img/trash.svg') }});" value="">
                    <!-- /.standart-btn -->
                </form>
            </div>
        </div>
    @endforeach
@endsection
