@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => 'Просмотр'])

@section('content')
    @foreach($shop as $Unit)
        <div class="card">
            <div class="card-body">
                <fieldset disabled>
                    @php
                        $UnitName   = $Unit->Name;
                        $UnitLink   = $Unit->Link;
                    @endphp
                    @include('parts.name')
                </fieldset>
                    @include('parts.link_show')
            </div>
            <div class="card-body d-flex justify-content-around">
                <a href="{{ route('shops.edit', ['id' => $Unit->ID]) }}" class=" btn edit_btn">
                    <img src="{{ '/storage/img/pencil.svg' }}" alt="edit">
                </a>
                <form action="{{ route('shops.destroy', ['id' => $Unit->ID]) }}"
                      class="delete-btn"
                      method="post"
                      onsubmit="return confirm('Удалить магазин {{$Unit->Name}}? Будут удалены ВСЕ связи магазина с растениями! (Растения не удалятся.)');">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn standart-btn" aria-label="Close" style="background-image: url({{ asset('/storage/img/trash.svg') }});" value="">
                    <!-- /.standart-btn -->
                </form>
            </div>
        </div>
    @endforeach
@endsection
