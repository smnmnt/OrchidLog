<div class="row mb-3">
    <label for="Name" class="col-form-label">{{ __('basic.name') }}</label>
	<input class="form-control" type="text" name="Name" id="Name" placeholder="{{ __('basic.name') }}" required value="{{ old('Name') ?? $UnitName ?? '' }}">

</div>
