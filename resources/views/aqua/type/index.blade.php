@extends('layouts.layout', ['title' => 'Типы тестов'])

@section('content')
	{{-- @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\AquaTestTypes> $types --}}

	<div class="container mt-4">
		<div class="d-flex justify-content-between align-items-center mb-3">
			<h2>Типы тестов</h2>
			<a href="{{ route('aqua.types.create') }}" class="btn btn-success">{{ __('basic.add') }}</a>
		</div>

		<div style="overflow-x:auto; -webkit-overflow-scrolling: touch;">
			<table class="table table-striped table-bordered text-center align-middle">
				<thead>
				<tr>
					<th>Код</th>
					<th>Единица</th>
					<th>Норма</th>
					<th>#</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				@forelse($types as $type)
					<tr>
						<td>{{ $type->name }}</td>
						<td>{{ $type->unit ?? '—' }}</td>
						<td>
							@if($type->value_min !== null && $type->value_max !== null)
								{{ $type->value_min }} - {{ $type->value_max }}
							@else
								—
							@endif
						</td>
						<td>{{ $type->results_count }}</td>
						<td>
							<a href="{{ route('aqua.types.edit', ['id' => $type->id]) }}" class="btn btn-sm btn-success">Править</a>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="5">{{ __('basic.nothings_here') }}</td>
					</tr>
				@endforelse
				</tbody>
			</table>
		</div>
	</div>
@endsection
