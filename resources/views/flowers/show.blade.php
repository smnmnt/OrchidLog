@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => __('basic.watching')])
@php setlocale(LC_ALL, 'ru_RU.UTF-8');
    $nmeng = array('january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december');
    $nmrus = array('Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря');
@endphp
@section('content')

    @foreach($flowers as $Unit)
        @php
            $UnitName       = $Unit->Name;
            $UnitDOB        = $Unit->DOB;
            $UnitSize       = $Unit->Size;
            $UnitNotes      = $Unit->Notes;
        @endphp

        <div class="card">
            <div class="card-body">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                            <img src="{{ '/storage/img/home.svg' }}" alt="home">
                        </button>
                        <button class="nav-link" id="nav-camera-tab" data-bs-toggle="tab" data-bs-target="#nav-camera" type="button" role="tab" aria-controls="nav-camera" aria-selected="false">
                            <img src="{{ '/storage/img/camera.svg' }}" alt="camera">
                        </button>
                        <button class="nav-link" id="nav-blooms-tab" data-bs-toggle="tab" data-bs-target="#nav-blooms" type="button" role="tab" aria-controls="nav-blooms" aria-selected="false">
                            <img src="{{ '/storage/img/bloom.svg' }}" alt="blooms">
                        </button>
                        <button class="nav-link" id="nav-waterings-tab" data-bs-toggle="tab" data-bs-target="#nav-waterings" type="button" role="tab" aria-controls="nav-waterings" aria-selected="false">
                            <img src="{{ '/storage/img/drop.svg' }}" alt="waterings">
                        </button>
                        <button class="nav-link" id="nav-transplantings-tab" data-bs-toggle="tab" data-bs-target="#nav-transplantings" type="button" role="tab" aria-controls="nav-transplantings" aria-selected="false">
                            <img src="{{ '/storage/img/recycle.svg' }}" alt="transplantings">
                        </button>
                        <button class="nav-link" id="nav-diseases-tab" data-bs-toggle="tab" data-bs-target="#nav-diseases" type="button" role="tab" aria-controls="nav-diseases" aria-selected="false">
                            <img src="{{ '/storage/img/heartbreak.svg' }}" alt="diseases">
                        </button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        @include('flowers.parts.home')
                        <div class="card-body d-flex justify-content-around">
                            <a href="{{ route('flowers.edit', ['id' => $Unit->ID]) }}" class="btn edit_btn">
                                <img src="{{ '/storage/img/pencil.svg' }}" alt="edit">
                            </a>
                            <form action="{{ route('flowers.destroy', ['id' => $Unit->ID]) }}"
                                  class="delete-btn"
                                  method="post"
                                  onsubmit="return confirm('{{ __('flower.del_d',['name' => $Unit->Name])}}');">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="btn standart-btn" aria-label="Close" style="background-image: url({{ asset('/storage/img/trash.svg') }});" value="">
                                <!-- /.standart-btn -->
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-camera" role="tabpanel" aria-labelledby="nav-camera-tab">
                        @include('flowers.parts.gallery')
                    </div>

                    <div class="tab-pane fade" id="nav-blooms" role="tabpanel" aria-labelledby="nav-blooms-tab">
                        @include('flowers.parts.blooms')
                    </div>

                    <div class="tab-pane fade" id="nav-waterings" role="tabpanel" aria-labelledby="nav-waterings-tab">
                        @include('flowers.parts.waterings')
                    </div>

                    <div class="tab-pane fade" id="nav-transplantings" role="tabpanel" aria-labelledby="nav-transplantings-tab">
                        @include('flowers.parts.transplantings')
                    </div>

                    <div class="tab-pane fade" id="nav-diseases" role="tabpanel" aria-labelledby="nav-diseases-tab">
                        @include('flowers.parts.diseases')
                    </div>
                </div>
            </div>
            @include('parts.modal_image')
        </div>
    @endforeach

    <script src="{{asset('./storage/modal_image.js')}}"></script>
@endsection
