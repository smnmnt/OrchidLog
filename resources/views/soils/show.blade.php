{{--@include('parts.nameLimiter')--}}

{{--@php--}}
{{--if (isset($soil)) {--}}
{{--    $title = nameLimiter($soil->first()->SoilName);--}}
{{--}--}}
{{--@endphp--}}

@extends('layouts.layout', ['title' => 'Просмотр'])

@section('content')
    @foreach($soil as $Unit)
        <div class="card">
            <div class="card-body">
                <fieldset disabled>
                    @php
                        $UnitName   = $Unit->Name;
                    @endphp
                    @include('parts.name')
                </fieldset>
            </div>
            <div class="card-body d-flex justify-content-around">
                <a href="{{ route('soils.edit', ['id' => $Unit->ID]) }}" class=" btn edit_btn">
                    <img src="{{ '/storage/img/pencil.svg' }}" alt="edit">
                </a>
                <form action="{{ route('soils.destroy', ['id' => $Unit->ID]) }}"
                      class="delete-btn"
                      method="post"
                      onsubmit="return confirm('Удалить почву {{$Unit->Name}}? Будут удалены ВСЕ связанные с почвой пересадки! (Растения не удалятся.)');">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger standart-btn btn-close" aria-label="Close" value="">
                    <!-- /.standart-btn -->
                </form>
            </div>
        </div>
    @endforeach
@endsection
