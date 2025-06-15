<div class="row mb-3">
    <label for="MOT" class="form-label">{{ __('disease.mot') }}</label>
	<textarea class="form-control form-text" name="MOT" id="MOT" rows="3" placeholder="{{ __('disease.mot') }}">{{ old('MOT') ?? $UnitMOT ?? '' }}</textarea>

</div>
