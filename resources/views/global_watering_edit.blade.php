@extends('layouts.layout', ['title' => 'Полив'])

@section('content')
    <div class="container mt-4">
        <h2>Редактирование полива от {{ \Carbon\Carbon::parse($watering->WateringDate)->format('d.m.Y') }}</h2>
        <form method="POST" action="{{ route('global_watering.update', $watering->ID) }}" method="post" class="form-box" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group mb-3">
                <label for="WateringDate">Дата полива</label>
                <input type="date" class="form-control" name="WateringDate" value="{{ $watering->WateringDate }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="TypeID">Тип полива</label>
                <select class="form-control" name="TypeID" required>
                    @foreach($types as $type)
                        <option value="{{ $type->ID }}" {{ $type->ID == $watering->TypeID ? 'selected' : '' }}>
                            {{ $type->WateringName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="FertilizerID">Удобрение</label>
                <select class="form-control" name="FertilizerID">
                    <option value="">—</option>
                    @foreach($fertilizers as $fertilizer)
                        <option value="{{ $fertilizer->ID }}" {{ $fertilizer->ID == $watering->FertilizerID ? 'selected' : '' }}>
                            {{ $fertilizer->Name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="FertilizerDoze">Дозировка удобрения</label>
                <input type="text" class="form-control" name="FertilizerDoze" value="{{ $watering->FertilizerDoze }}">
            </div>

            <hr>
            <h4>Выбери цветы, которые были политы:</h4>
            <div class="row">
                <div class="mb-3">
                    <label for="flower-filter" class="form-label">Фильтр цветов:</label>
                    <select id="flower-filter" class="form-select">
                        <option value="all">Все</option>
                        <option value="blooming">Цветущие</option>
                        <option value="sick">Больные</option>
                    </select>
                </div>
                @foreach($allFlowers as $flower)
                    <div class="col-md-4 flower-box"
                         data-blooming="{{ $flower->isBlooming ? '1' : '0' }}"
                         data-sick="{{ $flower->isSick ? '1' : '0' }}">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="flowers[]" value="{{ $flower->ID }}"
                                {{ in_array($flower->ID, $selectedFlowerIds) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $flower->Name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn btn-primary mt-4">Сохранить изменения</button>
        </form>

        <form action="{{ route('global_watering.destroy', ['id' => $watering->ID]) }}"
              class="delete-btn justify-content-start mt-4"
              method="post"
              onsubmit="return confirm('Удалить полив {{$watering->WateringDate}}?');">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" aria-label="Close" name="del-but" value="Удалить полив">
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filter = document.getElementById('flower-filter');
            const flowerBoxes = document.querySelectorAll('.flower-box');

            filter.addEventListener('change', function () {
                const value = this.value;

                flowerBoxes.forEach(box => {
                    const isBlooming = box.dataset.blooming === '1';
                    const isSick = box.dataset.sick === '1';

                    if (value === 'all') {
                        box.style.display = '';
                    } else if (value === 'blooming') {
                        box.style.display = isBlooming ? '' : 'none';
                    } else if (value === 'sick') {
                        box.style.display = isSick ? '' : 'none';
                    }
                });
            });
        });
    </script>
@endsection
{{--@if(isset($fertilizers) && sizeof($fertilizers))--}}
{{--    @foreach($fertilizers as $fertilizer)--}}
{{--        {{$fertilizer->FertilizerName}}--}}
{{--    @endforeach--}}
{{--@else--}}
{{--    NAnnnn--}}
{{--@endif--}}
