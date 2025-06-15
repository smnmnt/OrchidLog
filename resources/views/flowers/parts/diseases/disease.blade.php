<div class="row mb-3">
    <label for="TypeID" class="form-label">{{ __('disease.d') }}</label>
	<select class="form-select" name="TypeID" id="TypeID" aria-label="{ __('disease.d') }}" required>
		@if(empty($old_type))
			<option selected disabled>{{ __('basic.sel') }}</option>
		@else
			<option value="{{ $old_type->ID }}" name="{{ $old_type->Name }}" id="{{ $old_type->Name }}">{{ $old_type->Name }}</option>
		@endif
		@if(isset($types) && sizeof($types))
			@foreach($types as $type)
				<option value="{{ $type->ID }}" name="{{ $type->Name }}" id="{{ $type->Name }}">{{ $type->Name }}</option>
			@endforeach
		@endif
	</select>
</div>
