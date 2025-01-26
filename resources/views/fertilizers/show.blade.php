@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => 'Просмотр'])

@section('content')
    @foreach($fertilizer as $Unit)
        <div class="card">
            <div class="card-body">
                <fieldset disabled>
                    @php
                        $UnitName   = $Unit->Name;
                        $UnitDesc   = $Unit->Desc;
                    @endphp
                    @include('parts.name')
                    @include('parts.desc')
                </fieldset>
            </div>
            <div class="card-body d-flex justify-content-around">
                <a href="{{ route('fertilizers.edit', ['id' => $Unit->ID]) }}" class=" btn edit_btn">
                    <img src="{{ '/storage/img/pencil.svg' }}" alt="edit">
                </a>
                <form action="{{ route('fertilizers.destroy', ['id' => $Unit->ID]) }}"
                      class="delete-btn"
                      method="post"
                      onsubmit="return confirm('Удалить удобрение {{$Unit->Name}}? Будут удалены ВСЕ связанные с удобрением поливы! (Растения не удалятся.)');">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger standart-btn btn-close" aria-label="Close" value="">
                    <!-- /.standart-btn -->
                </form>
            </div>
        </div>
    @endforeach
@endsection
