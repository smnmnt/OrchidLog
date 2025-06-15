@props(['for', 'label', 'required' => false])

<label for="{{ $for }}">
	{{ $label }}
@if($required && empty($attributes['disabled']))
		<span class="text-danger">*</span>
	@endif
	{{ $slot }}
</label>
