<div class="row mb-3">
	<label for="name" class="form-label">Название</label>
	<input
		type="text"
		class="form-control @error('name') is-invalid @enderror"
		name="name"
		id="name"
		value="{{ old('name', $type->name ?? '') }}"
		required
	>
	@error('name')
		<div class="invalid-feedback">{{ $message }}</div>
	@enderror
</div>

<div class="row mb-3">
	<label for="unit" class="form-label">Единица измерения</label>
	<input
		type="text"
		class="form-control @error('unit') is-invalid @enderror"
		name="unit"
		id="unit"
		value="{{ old('unit', $type->unit ?? '') }}"
	>
	@error('unit')
		<div class="invalid-feedback">{{ $message }}</div>
	@enderror
</div>

<div class="row mb-3">
	<label for="value_min" class="form-label">Минимум нормы</label>
	<input
		type="number"
		step="0.01"
		class="form-control @error('value_min') is-invalid @enderror"
		name="value_min"
		id="value_min"
		value="{{ old('value_min', $type->value_min ?? '') }}"
	>
	@error('value_min')
		<div class="invalid-feedback">{{ $message }}</div>
	@enderror
</div>

<div class="row mb-3">
	<label for="value_max" class="form-label">Максимум нормы</label>
	<input
		type="number"
		step="0.01"
		class="form-control @error('value_max') is-invalid @enderror"
		name="value_max"
		id="value_max"
		value="{{ old('value_max', $type->value_max ?? '') }}"
	>
	@error('value_max')
		<div class="invalid-feedback">{{ $message }}</div>
	@enderror
</div>

<div class="row mb-3">
	<label for="description" class="form-label">Описание</label>
	<textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{ old('description', $type->description ?? '') }}</textarea>
	@error('description')
		<div class="invalid-feedback">{{ $message }}</div>
	@enderror
</div>
