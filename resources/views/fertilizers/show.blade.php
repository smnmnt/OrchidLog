<!--
@if(mb_strlen($fertilizer->first()->FertilizerName)>10)
    {{
        $title = mb_substr($fertilizer->first()->FertilizerName, 0 , 10),
        $title .= '...'
    }}
@else
    {{$title = $fertilizer->first()->FertilizerName}}
@endif
-->
@extends('layouts.layout', ['title' => $title])

@section('content')
    @foreach($fertilizer as $fertilizer_un)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{$fertilizer_un->FertilizerName}}</h5>
                <p class="card-text">{{$fertilizer_un->FertilizerDesc}}</p>
            </div>
            <div class="card-body d-flex justify-content-around">
                <a href="{{ route('fertilizers.edit', ['id' => $fertilizer_un->FertilizerID]) }}" class=" btn edit_btn">
                    <img src="{{ '/storage/img/pencil.svg' }}" alt="edit">
                </a>
                <form action="{{ route('fertilizers.destroy', ['id' => $fertilizer_un->FertilizerID]) }}"
                      class="delete-btn"
                      method="post"
                      onsubmit="return confirm('Удалить удобрение {{$fertilizer_un->FertilizerName}}? Будут удалены ВСЕ связанные с удобрением поливы! (Растения не удалятся.)');">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger standart-btn btn-close" aria-label="Close" value="">
                    <!-- /.standart-btn -->
                </form>
            </div>
        </div>
    @endforeach
@endsection
