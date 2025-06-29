@extends('layouts.layout', ['title' => __('wtr.d')])

@section('content')
    <div class="container mt-4">
        <p	class="d-flex justify-content-center text-center fs-4">{{ __('wtr.editing_d') }} <br> {{ \Carbon\Carbon::parse($watering->WateringDate)->format('d.m.Y') }}</p>
        <form method="POST" action="{{ route('global_watering.update', $watering->ID) }}" method="post" class="form-box" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row mb-3">
                <label for="WateringDate" class="form-label">{{ __('wtr.wd') }}</label>
				<input type="date" class="form-control" name="WateringDate" id="WateringDate" value="{{ $watering->WateringDate }}" required>
            </div>

            <div class="row mb-3">
                <label for="TypeID" class="form-label">{{ __('wtr.name_d') }}</label>
				<select class="form-control" name="TypeID" id="TypeID" required>
					@foreach($types as $type)
						<option value="{{ $type->ID }}" {{ $type->ID == $watering->TypeID ? 'selected' : '' }}>
							{{ $type->WateringName }} {{ $type->TypeOfImg }}
						</option>
					@endforeach
				</select>
            </div>

            <div class="row mb-3">
                <label for="FertilizerID" class="form-label">{{ __('wtr.fert') }}</label>
				<select class="form-control form-select" name="FertilizerID" id="FertilizerID">
					<option value="">—</option>
					@foreach($fertilizers as $fertilizer)
						<option value="{{ $fertilizer->ID }}" {{ $fertilizer->ID == $watering->FertilizerID ? 'selected' : '' }}>
							{{ $fertilizer->Name }}
						</option>
					@endforeach
				</select>
			</div>

            <div class="row mb-3">
                <label for="FertilizerDoze" class="form-label">{{ __('wtr.doze') }}</label>
				<input type="text" class="form-control" name="FertilizerDoze" id="FertilizerDoze" value="{{ $watering->FertilizerDoze }}">
			</div>

            <div class="row mb-3">
                <label for="GroupID" class="form-label">{{ __('wtr.wg') }}</label>
				<select class="form-control form-select" name="GroupID" id="GroupID">
					<option value="">{{ __('wtr.all_p') }}</option>
					@foreach($groups as $group)
						<option value="{{ $group->ID }}" {{ $group->ID == $watering->GroupID ? 'selected' : '' }}>
							{{ $group->Name }}
						</option>
					@endforeach
				</select>
			</div>

            <hr>
            <p class="row text-center justify-content-center fs-5">{{ __('wtr.sel_d') }}</p>
            <div class="mb-5">
                <div class="row mb-3">
                    <label for="watering-date-filter" class="form-label">Дата полива:</label>
                    <input type="date" id="watering-date-filter" class="form-control" value="{{ $watering->WateringDate }}">
                </div>
                <div class="row mb-3">
                    <label for="flower-filter" class="form-label">Фильтр цветов:</label>
                    <select id="flower-filter" class="form-select">
                        <option value="all">{{ __('wtr.f_all') }}</option>
                        <option value="blooming">{{ __('wtr.f_blooming') }}</option>
                        <option value="sick">{{ __('wtr.f_disease') }}</option>
                        <option value="by-date">С поливом на дату</option>
                    </select>
                </div>
                <div class="mb-5 mt-5 d-flex justify-content-around">
                    <button type="button" class="btn btn-outline-primary btn-sm me-2" id="select-all">Выбрать все</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="deselect-all">Снять выбор</button>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($allFlowers as $flower)
                        <div class="col flower-box"
                             data-blooming="{{ $flower->isBlooming ? '1' : '0' }}"
                             data-sick="{{ $flower->isSick ? '1' : '0' }}"
                             data-watering-dates="{{ implode(',', $flower->wateringDates ?? []) }}">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="flowers[]" value="{{ $flower->ID }}"
                                    {{ in_array($flower->ID, $selectedFlowerIds) ? 'checked' : '' }} id="flower-{{ $flower->ID }}">
                                <label class="form-check-label" for="flower-{{ $flower->ID }}">
                                    {{ $flower->Name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
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
            const dateInput = document.getElementById('watering-date-filter');
            const flowerBoxes = document.querySelectorAll('.flower-box');

            function updateVisibility() {
                const value = filter.value;
                const selectedDate = dateInput.value;
                flowerBoxes.forEach(box => {
                    const isBlooming = box.dataset.blooming === '1';
                    const isSick = box.dataset.sick === '1';
                    const wateringDates = (box.dataset.wateringDates || '').split(',');

                    let show = false;
                    if (value === 'all') show = true;
                    else if (value === 'blooming') show = isBlooming;
                    else if (value === 'sick') show = isSick;
                    else if (value === 'by-date') show = !wateringDates.includes(selectedDate);

                    box.style.display = show ? '' : 'none';
                });
            }

            filter.addEventListener('change', function () {
                updateVisibility();
            });

            dateInput.addEventListener('input', function () {
                if (filter.value === 'by-date') {
                    updateVisibility();
                }
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
