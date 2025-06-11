<div class="row mb-3">
	<label class="col-form-label" for="peduncle">{{ __('bloom.peduncle') }}
	<select class="form-select" name="peduncle" id="peduncle">
		<option value="1" {{ old('peduncle', $Peduncle ?? null) == 1 ? 'selected' : '' }}>{{ __('basic.new') }}</option>
		<option value="0" {{ old('peduncle', $Peduncle ?? null) == 0 ? 'selected' : '' }}>{{ __('basic.old') }}</option>
	</select></label>
</div>
