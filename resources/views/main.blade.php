@extends('layouts.layout', ['title' => 'Главная'])

@section('content')
@if($flower)

    <div class="card text-center mt-4">
        <img src="{{ asset($flower->ImageLink) }}" class="card-img-top mx-auto" style="max-height: 300px; width: auto;" alt="{{ $flower->Name }}">
        <div class="card-body">
            <h5 class="card-title">{{ $flower->Name }}</h5>
            <a href="{{ route('flowers.show', ['id' => $flower->ID]) }}" class="btn btn-primary" style="background-color: var(--base_color2); border: none;">Посмотреть</a>
        </div>
    </div>
 
@endif
@endsection

{{-- @php phpinfo() @endphp --}}

{{--@if(isset($fertilizers) && sizeof($fertilizers))--}}
{{--    @foreach($fertilizers as $fertilizer)--}}
{{--        {{$fertilizer->FertilizerName}}--}}
{{--    @endforeach--}}
{{--@else--}}
{{--    NAnnnn--}}
{{--@endif--}}
