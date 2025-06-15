<div class="row mb-3">
    <label for="FertilizerID" class="form-label">{{ __('wtr.fert') }}</label>
	<select class="form-select" name="FertilizerID" id="FertilizerID" aria-label="{{ __('wtr.fert') }}">
		@if(empty($old_fertilizer))
			<option selected disabled>{{ __('basic.sel') }}</option>
		@else
			<option value="{{ $old_fertilizer->ID }}" name="{{ $old_fertilizer->Name }}" id="{{ $old_fertilizer->Name }}">{{ $old_fertilizer->Name }}</option>
		@endif
		@if(isset($fertilizers) && sizeof($fertilizers))
			@foreach($fertilizers as $fertilizer)
				<option value="{{ $fertilizer->ID }}" name="{{ $fertilizer->Name }}" id="{{ $fertilizer->Name }}">{{ $fertilizer->Name }}</option>
			@endforeach
		@endif
	</select>
</div>
