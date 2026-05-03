@extends('layouts.layout', ['title' => 'Редактировать тест воды'])

@section('content')
	{{-- @var \App\Models\AquaTests $test --}}
	{{-- @var \Illuminate\Support\Collection<int, string> $resultValues --}}

	<div class="container mt-4">
		<h2 class="mb-3">Редактировать тест воды</h2>

		<div class="d-flex gap-2 mb-3">
			<a href="{{ route('aqua.aquariums.create') }}" class="btn btn-outline-success btn-sm">Добавить аквариум</a>
			<a href="{{ route('aqua.types.create') }}" class="btn btn-outline-success btn-sm">Добавить тип теста</a>
		</div>

		<form method="POST" action="{{ route('aqua.test.update', ['id' => $test->id]) }}" class="form-box">
			@csrf
			@method('PATCH')

			<div class="row mb-3">
				<label for="tested_at" class="form-label">Дата и время теста</label>
				<input
					type="datetime-local"
					class="form-control @error('tested_at') is-invalid @enderror"
					name="tested_at"
					id="tested_at"
					value="{{ old('tested_at', $test->tested_at?->format('Y-m-d\TH:i')) }}"
					required
				>
				@error('tested_at')
					<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<div class="row mb-3">
				<label for="source_type" class="form-label">Источник воды</label>
				<select class="form-control @error('source_type') is-invalid @enderror" name="source_type" id="source_type" required>
					<option value="{{ \App\Models\AquaTests::SOURCE_TYPE_AQUARIUM }}" @selected(old('source_type', $test->source_type) === \App\Models\AquaTests::SOURCE_TYPE_AQUARIUM)>
						Аквариум
					</option>
					<option value="{{ \App\Models\AquaTests::SOURCE_TYPE_TAP }}" @selected(old('source_type', $test->source_type) === \App\Models\AquaTests::SOURCE_TYPE_TAP)>
						Водопровод
					</option>
				</select>
				@error('source_type')
					<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<div class="row mb-3" id="aquarium-field">
				<label for="aquarium_id" class="form-label">Аквариум</label>
				<select class="form-control @error('aquarium_id') is-invalid @enderror" name="aquarium_id" id="aquarium_id">
					<option value="">Выберите аквариум</option>
					@foreach($aquariums as $aquarium)
						<option value="{{ $aquarium->id }}" @selected((string) old('aquarium_id', $test->aquarium_id) === (string) $aquarium->id)>
							{{ $aquarium->name }}
						</option>
					@endforeach
				</select>
				@error('aquarium_id')
					<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<div class="row mb-3" id="source-name-field">
				<label for="source_name" class="form-label">Название источника</label>
				<input
					type="text"
					class="form-control @error('source_name') is-invalid @enderror"
					name="source_name"
					id="source_name"
					value="{{ old('source_name', $test->source_name ?: 'Водопровод') }}"
					placeholder="Например: водопровод кухня, осмос, бутилированная"
				>
				@error('source_name')
					<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<div class="row mb-3">
				<label for="notes" class="form-label">Примечание</label>
				<textarea class="form-control @error('notes') is-invalid @enderror" name="notes" id="notes" rows="3">{{ old('notes', $test->notes) }}</textarea>
				@error('notes')
					<div class="invalid-feedback">{{ $message }}</div>
				@enderror
			</div>

			<hr>

			<h4 class="mb-3">Показатели</h4>

			@foreach($types as $type)
				<div class="row mb-3">
					<label for="result-{{ $type->id }}" class="form-label">
						{{ $type->name }}
						@if($type->unit)
							, {{ $type->unit }}
						@endif
						@if($type->value_min !== null && $type->value_max !== null)
							<span class="text-muted">({{ $type->value_min }} - {{ $type->value_max }})</span>
						@endif
					</label>
					<input
						type="number"
						step="0.01"
						class="form-control @error('results.'.$type->id) is-invalid @enderror"
						name="results[{{ $type->id }}]"
						id="result-{{ $type->id }}"
						value="{{ old('results.'.$type->id, $resultValues[$type->id] ?? '') }}"
					>
					@error('results.'.$type->id)
						<div class="invalid-feedback">{{ $message }}</div>
					@enderror
				</div>
			@endforeach

			@include('parts.submit')
		</form>

		<form action="{{ route('aqua.test.destroy', ['id' => $test->id]) }}"
			  class="delete-btn justify-content-end mt-4"
			  method="post"
			  onsubmit="return confirm('Удалить тест воды?');">
			@csrf
			@method('DELETE')
			<input type="submit" class="btn btn-danger" aria-label="Close" name="del-but" value="{{ __('basic.del') }}">
		</form>
	</div>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const source = document.getElementById('source_type');
			const aquariumField = document.getElementById('aquarium-field');
			const sourceNameField = document.getElementById('source-name-field');

			function toggleAquarium() {
				const isAquarium = source.value === '{{ \App\Models\AquaTests::SOURCE_TYPE_AQUARIUM }}';

				aquariumField.style.display = isAquarium ? '' : 'none';
				sourceNameField.style.display = isAquarium ? 'none' : '';
			}

			source.addEventListener('change', toggleAquarium);
			toggleAquarium();
		});
	</script>
@endsection
