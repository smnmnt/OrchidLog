<div class="row mb-3">
    <p>{{ __('tp.sel_s') }}</p>
    @if(!empty($old_soils))
        @foreach($old_soils as $soil)
            <div class="form-check checkbox-soils">
                <label for="soil_checkbox{{ $soil->ID }}" class="form-check-label">{{ $soil->Name }}</label>
				<input class="form-check-input" checked type="checkbox" name="soil_checkbox[]" value="{{ $soil->ID }}" id="soil_checkbox{{ $soil->ID }}">
			</div>
        @endforeach
    @endif
    @if(!empty($soils))
        @foreach($soils as $soil)
            <div class="form-check checkbox-soils">
                <label for="soil_checkbox{{ $soil->ID }}" class="form-check-label">{{ $soil->Name }}</label>
				<input class="form-check-input" type="checkbox" name="soil_checkbox[]" value="{{ $soil->ID }}" id="soil_checkbox{{ $soil->ID }}">
			</div>
        @endforeach
    @else
        <p>{{ __('tp.empty_s') }}</p>
        <li class="list-group-item mb-5"><a href="{{route('soils.create') }}" class="link-primary">{{ __('basic.add') }}</a></li>
    @endif
</div>
