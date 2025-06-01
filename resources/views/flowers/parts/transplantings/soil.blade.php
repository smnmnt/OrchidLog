<div class="row mb-3">
    <p>Выберите составляющие почвы:</p>
    @if(!empty($old_soils))
        @foreach($old_soils as $soil)
            <div class="form-check checkbox-soils">
                <label class="form-check-label">{{ $soil->Name }}
                    <input class="form-check-input" checked type="checkbox" name="soil_checkbox[]" value="{{ $soil->ID }}" id="soil_checkbox{{ $soil->ID }}">
                </label>
            </div>
        @endforeach
    @endif
    @if(!empty($soils))
        @foreach($soils as $soil)
            <div class="form-check checkbox-soils">
                <label class="form-check-label">{{ $soil->Name }}
                    <input class="form-check-input" type="checkbox" name="soil_checkbox[]" value="{{ $soil->ID }}" id="soil_checkbox{{ $soil->ID }}">
                </label>
            </div>
        @endforeach
    @else
        <p>В БД нет почв.</p>
        <li class="list-group-item mb-5"><a href="{{route('soils.create') }}" class="link-primary">Добавить</a></li>
    @endif
</div>
