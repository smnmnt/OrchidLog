<div class="row mb-3">
    <label for="DOB" class="col-form-label">{{ __('flower.dob') }}</label>
	<input class="form-control" type="date" name="DOB" id="DOB" placeholder="{{ __('flower.dob') }}" required value="{{ old('DOB') ?? $UnitDOB ?? '' }}">

</div>
