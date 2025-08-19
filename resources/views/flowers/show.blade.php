@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => __('basic.watching')])
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
                            <img src="{{ '/storage/img/droplet2.svg' }}" alt="waterings">
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

					@if($Unit->archived)
								<div class="alert alert-primary" role="alert">
									<div class="d-flex align-items-center">
										<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
											<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
										</svg>
										<div>
											Растение находится в архиве.
										</div>
									</div>
									<p class="text-muted fs-6 mb-0">
										Дата занесения в архив: <span class="font-bold">{{ $Unit->archived_at }}</span>
									</p>
								</div>
					@endif
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        @include('flowers.parts.home')
                        <div class="card-body d-flex justify-content-around">
                            <a href="{{ route('flowers.edit', ['id' => $Unit->ID]) }}" class="btn edit_btn">
                                <img src="{{ '/storage/img/pencil.svg' }}" alt="edit">
                            </a>
							@if($Unit->archived)
								<form action="{{ route('flowers.unarchive', ['id' => $Unit->ID]) }}"
									  class="delete-btn"
									  method="POST"
									  onsubmit="return confirm('{{ __('flower.unarc_d',['name' => $Unit->Name])}}');">
									@csrf
									@method('PATCH')
									<input type="submit" class="btn standart-btn" aria-label="Close" style="background-image: url({{ asset('/storage/img/recycle.svg') }});" value="">
									<!-- /.standart-btn -->
								</form>
							@else
								<form action="{{ route('flowers.archive', ['id' => $Unit->ID]) }}"
									  class="delete-btn"
									  method="POST"
									  onsubmit="return confirm('{{ __('flower.arc_d',['name' => $Unit->Name])}}');">
									@csrf
									@method('PATCH')
									<input type="submit" class="btn standart-btn" aria-label="Close" style="background-image: url({{ asset('/storage/img/trash.svg') }});" value="">
									<!-- /.standart-btn -->
								</form>
							@endif
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

    <script src="{{asset('./js/modal_image.js')}}"></script>
@endsection
