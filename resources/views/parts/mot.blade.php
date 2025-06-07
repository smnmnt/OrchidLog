<div class="row mb-3">
    <label for="MOT" class="form-label">{{ __('disease.mot') }}
        <textarea class="form-control" name="MOT" id="MOT" rows="3" placeholder="{{ __('disease.mot') }}">{{ old('MOT') ?? $UnitMOT ?? '' }}</textarea>
    </label>
</div>
