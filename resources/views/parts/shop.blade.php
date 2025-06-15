<div class="row mb-3">
    <label for="ShopID" class="form-label">{{ __('flower.shop') }}</label>
	<select class="form-select" name="ShopID" id="ShopID" aria-label="{{ __('flower.sel_shop') }}">
		@if(empty($old_shop))
			<option selected disabled>{{ __('flower.sel_shop') }}</option>
		@else
			@foreach($old_shop as $old_el)
				<option value="{{ $old_el->ID }}" name="{{ $old_el->Name }}" id="{{ $old_el->Name }}">{{ $old_el->Name }}</option>
				@break
			@endforeach
		@endif
		@if(isset($shops) && sizeof($shops))
			@foreach($shops as $shop)
				<option value="{{ $shop->ID }}" name="{{ $shop->Name }}" id="{{ $shop->Name }}">{{ $shop->Name }}</option>
			@endforeach
		@endif
	</select>

</div>
