<div class="row mb-3">
    <label for="Name" class="col-form-label">{{ __('basic.name') }}
        <input class="form-control" type="text" name="Name" placeholder="{{ __('basic.name') }}" required value="{{ old('Name') ?? $UnitName ?? '' }}">
    </label>
</div>
