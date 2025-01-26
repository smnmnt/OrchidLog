{{--@include('parts.nameLimiter')--}}

{{--@php--}}
{{--    if (isset($disease)) {--}}
{{--        $title = nameLimiter($disease->first()->DiseaseName);--}}
{{--    }--}}
{{--@endphp--}}

@extends('layouts.layout', ['title' => 'Просмотр'])

@section('content')
    @foreach($disease as $Unit)
        <div class="card">
            <div class="card-body">
                <fieldset disabled>
                    @php
                        $UnitName   = $Unit->Name;
                        $UnitDesc   = $Unit->Desc;
                        $UnitMOT    = $Unit->MOT;
                    @endphp
                    @include('parts.name')
                    @include('parts.desc')
                    @include('parts.mot')
                </fieldset>
            </div>
            <div class="card-body d-flex justify-content-around">
                <a href="{{ route('diseases.edit', ['id' => $Unit->ID]) }}" class=" btn edit_btn">
                    <img src="{{ '/storage/img/pencil.svg' }}" alt="edit">
                </a>
                <form action="{{ route('diseases.destroy', ['id' => $Unit->ID]) }}"
                      class="delete-btn"
                      method="post"
                      onsubmit="return confirm('Удалить недуг {{$Unit->Name}}? Недуг будет отвязан от растений и удален! (Растения не удалятся.)');">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger standart-btn btn-close" aria-label="Close" value="">
                    <!-- /.standart-btn -->
                </form>
            </div>
        </div>
    @endforeach
@endsection
