@include('parts.nameLimiter')

@extends('layouts.layout', ['title' =>  __('flower.ds')])

@section('content')
    <div class="container">
        <p class="mb-1">Поиск растений</p>
        <form method="GET" action="{{ route('flowers.search') }}" class="mb-4">
            <div class="input-group mb-3">
                <input type="text" name="query" class="form-control" placeholder="Введите название или описание цветка..." value="{{ request('query') }}">
                <button class="btn btn-primary" type="submit">Поиск</button>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="view" id="listView" value="list" {{ request('view', 'cards') === 'list' ? 'checked' : '' }}>
                <label class="form-check-label" for="listView">Список</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="view" id="cardView" value="cards" {{ request('view', 'cards') === 'cards' ? 'checked' : '' }}>
                <label class="form-check-label" for="cardView">Карточки</label>
            </div>
        </form>

        <div class="mb-3">
            <label for="sort" class="form-label">Сортировка</label>
            <select id="sort" name="sort" class="form-select" onchange="handleSortChange(this)">
                <option value="">По умолчанию</option>
                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>По названию (А-Я)</option>
                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>По названию (Я-А)</option>
                <option value="created_desc" {{ request('sort') == 'created_desc' ? 'selected' : '' }}>Сначала новые</option>
                <option value="created_asc" {{ request('sort') == 'created_asc' ? 'selected' : '' }}>Сначала старые</option>
				<option value="dev" {{ request('sort') == 'dev' ? 'selected' : '' }}>[[Отладка]]</option>
            </select>
        </div>

        @if(isset($flowers))
            @if($flowers->isEmpty())
                <div class="alert alert-warning">Ничего не найдено.</div>
            @else
                @if(request('view', 'cards') === 'cards')
					<div class="mb-3 mt-3">
						{{ $cardFlowers->onEachSide(1)->links('pagination::bootstrap-5') }}
					</div>
					<div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($cardFlowers as $flower)
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
                                            <p class="card-desc fw-lighter" style="margin-bottom: 0;">
                                                {{ ($cardFlowers->currentPage() - 1) * $cardFlowers->perPage() + $loop->iteration }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
					<div class="mb-3 mt-3">
						{{ $cardFlowers->onEachSide(1)->links('pagination::bootstrap-5') }}
					</div>
				@else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Название</th>
                                <th>Описание</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($flowers as $index => $flower)
                                <tr onclick="window.location='{{ route('flowers.show', ['id' => $flower->ID]) }}'" style="cursor: pointer; padding: 1rem">
                                    <td style="padding: 1rem">{{ $loop->iteration }} </td>
                                    <td style="padding: 1rem">{{ $flower->Name }}</td>
                                    <td style="padding: 1rem">{{ $flower->Notes }}</td>
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
        function handleSortChange(select) {
            const url = new URL(window.location.href);
            url.searchParams.set('sort', select.value);
            window.location.href = url.toString();
        }
    </script>
@endsection
