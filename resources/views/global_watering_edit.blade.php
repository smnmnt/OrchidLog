@extends('layouts.layout', ['title' => __('wtr.d')])

@section('content')
    <div class="container mt-4">
        <h2>{{ __('wtr.edit_d') }} {{ \Carbon\Carbon::parse($watering->WateringDate)->format('d.m.Y') }}</h2>
        <form method="POST" action="{{ route('global_watering.update', $watering->ID) }}" method="post" class="form-box" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row mb-3">
                <label for="WateringDate">{{ __('wtr.wd') }}*
                    <input type="date" class="form-control" name="WateringDate" value="{{ $watering->WateringDate }}" required>
                </label>
            </div>

            <div class="row mb-3">
                <label for="TypeID">{{ __('wtr.name_d') }}*
                    <select class="form-control" name="TypeID" required>
                        @foreach($types as $type)
                            <option value="{{ $type->ID }}" {{ $type->ID == $watering->TypeID ? 'selected' : '' }}>
                                {{ $type->WateringName }} {{ $type->TypeOfImg }}
                            </option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div class="row mb-3">
                <label for="FertilizerID">{{ __('wtr.fert') }}
                    <select class="form-control" name="FertilizerID">
                        <option value="">—</option>
                        @foreach($fertilizers as $fertilizer)
                            <option value="{{ $fertilizer->ID }}" {{ $fertilizer->ID == $watering->FertilizerID ? 'selected' : '' }}>
                                {{ $fertilizer->Name }}
                            </option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div class="row mb-3">
                <label for="FertilizerDoze">{{ __('wtr.doze') }}
                    <input type="text" class="form-control" name="FertilizerDoze" value="{{ $watering->FertilizerDoze }}">
                </label>
            </div>

            <div class="row mb-3">
                <label for="GroupID">{{ __('wtr.wg') }}
                    <select class="form-control" name="GroupID">
                        <option value="">{{ __('wtr.all_p') }}</option>
                        @foreach($groups as $group)
                            <option value="{{ $group->ID }}" {{ $group->ID == $watering->GroupID ? 'selected' : '' }}>
                                {{ $group->Name }}
                            </option>
                        @endforeach
                    </select>
                </label>
            </div>

            <hr>
            <h4>{{ __('wtr.sel_d') }}</h4>
            <div class="row mb-3">
                <div class="mb-3">
                    <label for="flower-filter" class="form-label">Фильтр цветов:</label>
                    <select id="flower-filter" class="form-select">
                        <option value="all">{{ __('wtr.f_all') }}</option>
                        <option value="blooming">{{ __('wtr.f_blooming') }}</option>
                        <option value="sick">{{ __('wtr.f_disease') }}</option>
                    </select>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-outline-primary btn-sm me-2" id="select-all">Выбрать все</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="deselect-all">Снять выбор</button>
                </div>
                @foreach($allFlowers as $flower)
                    <div class="col-md-4 mb-2 flower-box"
                         data-blooming="{{ $flower->isBlooming ? '1' : '0' }}"
                         data-sick="{{ $flower->isSick ? '1' : '0' }}">
                        <div class="form-check">
                            <label class="form-check-label">{{ $flower->Name }}
                                <input class="form-check-input" type="checkbox" name="flowers[]" value="{{ $flower->ID }}"
                                {{ in_array($flower->ID, $selectedFlowerIds) ? 'checked' : '' }}>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            @include('parts.submit')
        </form>

        <form action="{{ route('global_watering.destroy', ['id' => $watering->ID]) }}"
              class="delete-btn justify-content-end mt-4"
              method="post"
              onsubmit="return confirm('{{ __('wtr.del_d', ['name' => $watering->WateringDate]) }}');">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" aria-label="Close" name="del-but" value="{{ __('basic.del') }}">
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

                    let show = false;
                    if (value === 'all') show = true;
                    else if (value === 'blooming') show = isBlooming;
                    else if (value === 'sick') show = isSick;

                    box.style.display = show ? '' : 'none';
                });
            });

            document.getElementById('select-all').addEventListener('click', function () {
                document.querySelectorAll('.flower-box').forEach(box => {
                    if (box.style.display !== 'none') {
                        const checkbox = box.querySelector('.form-check-input');
                        if (checkbox) checkbox.checked = true;
                    }
                });
            });

            document.getElementById('deselect-all').addEventListener('click', function () {
                document.querySelectorAll('.flower-box').forEach(box => {
                    if (box.style.display !== 'none') {
                        const checkbox = box.querySelector('.form-check-input');
                        if (checkbox) checkbox.checked = false;
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
