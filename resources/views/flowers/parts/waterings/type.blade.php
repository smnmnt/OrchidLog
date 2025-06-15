<div class="row mb-3">
    <label for="TypeID" class="form-label">{{ __('wtr.name_d') }}</label>
	<select class="form-select" name="TypeID" id="TypeID" aria-label="{{ __('wtr.name_d') }}">
		@if(empty($old_type))
			<option selected disabled>{{ __('basic.sel') }}</option>
		@else
			<option value="{{ $old_type->ID }}" name="{{ $old_type->WateringName }}" id="{{ $old_type->WateringName }}">{{ $old_type->WateringName }}</option>
		@endif
		@if(isset($types) && sizeof($types))
			@foreach($types as $type)
				<option value="{{ $type->ID }}" name="{{ $type->WateringName }}" id="{{ $type->WateringName }}">{{ $type->WateringName }}</option>
			@endforeach
		@endif
	</select>
</div>
