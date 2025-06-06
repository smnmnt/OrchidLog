<div class="row mb-3">
    <label for="WateringDate" class="col-form-label">{{ __('wtr.wd') }}
        <input class="form-control" type="date" name="WateringDate" placeholder="{{ __('wtr.wd') }}" required value="{{ old('WateringDate') ?? $WateringDate ?? '' }}">
    </label>
</div>
