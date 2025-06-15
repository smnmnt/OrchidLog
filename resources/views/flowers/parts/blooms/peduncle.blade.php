<div class="row mb-3">
	<label class="col-form-label" for="peduncle">{{ __('bloom.peduncle') }}</label>
	<select class="form-select" name="peduncle" id="peduncle">
		<option value="0" {{ old('peduncle', $Peduncle ?? 1) == 0 ? 'selected' : '' }}>{{ __('basic.old') }}</option>
		<option value="1" {{ old('peduncle', $Peduncle ?? 1) == 1 ? 'selected' : '' }}>{{ __('basic.new') }}</option>
	</select>
</div>
