<div class="row mb-3">
	<label for="name" class="form-label">Название</label>
	<input
		type="text"
		class="form-control @error('name') is-invalid @enderror"
		name="name"
		id="name"
		value="{{ old('name', $aquarium->name ?? '') }}"
		required
	>
	@error('name')
		<div class="invalid-feedback">{{ $message }}</div>
	@enderror
</div>

<div class="row mb-3">
	<label for="volume" class="form-label">Объем, л</label>
	<input
		type="number"
		class="form-control @error('volume') is-invalid @enderror"
		name="volume"
		id="volume"
		value="{{ old('volume', $aquarium->volume ?? '') }}"
		min="0"
	>
	@error('volume')
		<div class="invalid-feedback">{{ $message }}</div>
	@enderror
</div>

<div class="row mb-3">
	<label for="description" class="form-label">Описание</label>
	<textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3">{{ old('description', $aquarium->description ?? '') }}</textarea>
	@error('description')
		<div class="invalid-feedback">{{ $message }}</div>
	@enderror
</div>
