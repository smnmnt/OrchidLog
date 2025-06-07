@extends('layouts.layout', ['title' => __('basic.m_tp')])

@section('content')
@if($flower)

{{--    <div class="card text-center mt-4">--}}
{{--        <img src="{{ asset($flower->ImageLink) }}" class="card-img-top mx-auto" style="max-height: 300px; width: auto;" alt="{{ $flower->Name }}">--}}
{{--        <div class="card-body">--}}
{{--            <h5 class="card-title">{{ $flower->Name }}</h5>--}}
{{--            <a href="{{ route('flowers.show', ['id' => $flower->ID]) }}" class="btn btn-primary" style="background-color: var(--base_color2); border: none;">{{ __('basic.goto') }}</a>--}}
{{--        </div>--}}
{{--    </div>--}}
<div class="row row-cols-1 row-cols-md-3 g-1 d-flex justify-content-center">
        <div class="col">
            <a href="{{ route('flowers.show', ['id' => $flower->ID]) }}">
                <div class="card h-100 d-flex flex-column justify-content-between">
                    @php
                        $img = DB::table('flower_images')->where('FlowerID', $flower->ID)->where('IsMain', true)->first();
                    @endphp
                    @if($img)
                        <div style="width: 100%; height: 250px; overflow: hidden;">
                            <img src="{{ $img->Link }}"
                                 style="object-fit: cover; width: 100%; height: 100%; display: block;"
                                 alt="{{ $flower->Name }}">
                        </div>
                    @else
                        <div style="width: 100%; height: 250px; overflow: hidden;">
                            <img src="{{ asset('/storage/img/exc_mrk.svg') }}"
                                 style="object-fit: cover; width: 100%; height: 100%; display: block; color: white"
                                 alt="{{ $flower->Name }}">
                        </div>
                    @endif
                    <div class="card-body" style="text-align: center">
                        <h5 class="card-title fw-light" style=" text-align: center">{{ $flower->Name }}</h5>
                    </div>
                </div>
            </a>
        </div>
</div>
@endif
@endsection
