@include('parts.nameLimiter')

@extends('layouts.layout', ['title' =>  __('flower.ds')])

{{--@section('content')--}}
{{--    @if(isset($flowers) && sizeof($flowers))--}}
{{--        <li class="list-group-item mb-5"><a href="{{route('flowers.create')}}" class="link-primary">{{  __('basic.add') }}</a></li>--}}
{{--        <ol class="list-group list-group-numbered">--}}
{{--            @foreach($flowers as $Unit)--}}
{{--                <a href="{{route('flowers.show', ['id' => $Unit->ID])}}">--}}
{{--                    <div class="card">--}}
{{--                        <img src="{{ $Unit->ImageLink }}" class="card-img-top" alt="{{nameLimiter($Unit->Name)}}">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">--}}{{-- $loop->iteration --}}{{-- {{ $loop->iteration." ".$Unit->Name}}</h5>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--            @endforeach--}}
{{--        </ol>--}}
{{--    @else--}}
{{--        <li class="list-group-item">Здесь пусто. <a href="{{route('flowers.create')}}" class="link-primary">{{  __('basic.add') }}</a></li>--}}
{{--    @endif--}}
{{--@endsection--}}

@section('content')
    <div class="container">
        <p class="mb-1">Поиск растений</p>
        <form method="GET" action="{{ route('flowers.search') }}" class="mb-4">
            <div class="input-group mb-3">
                <input type="text" name="query" class="form-control" placeholder="Введите название или описание цветка..." value="{{ request('query') }}">
                <button class="btn btn-primary" type="submit">Поиск</button>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="view" id="listView" value="list" {{ request('view', 'list') === 'list' ? 'checked' : '' }}>
                <label class="form-check-label" for="listView">Список</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="view" id="cardView" value="cards" {{ request('view') === 'cards' ? 'checked' : '' }}>
                <label class="form-check-label" for="cardView">Карточки</label>
            </div>
        </form>

        @if(isset($flowers))
            @if($flowers->isEmpty())
                <div class="alert alert-warning">Ничего не найдено.</div>
            @else
                @if(request('view', 'list') === 'cards')
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($flowers as $flower)
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
                                            <p class="card-desc fw-lighter" style="margin-bottom: 0;">{{ $loop->iteration }}</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название</th>
                                <th>Описание</th>
                                <th>Действие</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($flowers as $index => $flower)
                                <tr>
                                    <td>{{ $loop->iteration }} </td>
                                    <td>{{ $flower->Name }}</td>
                                    <td>{{ $flower->Notes }}</td>
                                    <td><a href="{{ route('flowers.show', ['id' => $flower->ID]) }}" class="btn btn-sm btn-outline-primary">Подробнее</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            @endif
        @endif
    </div>
    <script>
        document.querySelectorAll('input[name="view"]').forEach(radio => {
            radio.addEventListener('change', () => {
                const url = new URL(window.location.href);
                url.searchParams.set('view', radio.value);
                url.searchParams.set('query', document.querySelector('input[name="query"]').value);
                window.location.href = url.toString();
            });
        });
    </script>
@endsection
