<div class="row mb-3">
    <label for="Notes" class="form-label">{{ __('basic.notes') }}</label>
	<textarea class="form-control" name="Notes" id="Notes" rows="3" placeholder="{{ __('basic.notes') }}">{{ old('Notes') ?? $UnitNotes ?? '' }}</textarea>

</div>
