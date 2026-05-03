@extends('layouts.layout', ['title' => 'Аквариумы'])

@section('content')
	{{-- @var \Illuminate\Database\Eloquent\Collection<int, \App\Models\Aquariums> $aquariums --}}

	<div class="container mt-4">
		<div class="d-flex justify-content-between align-items-center mb-3">
			<h2>Аквариумы</h2>
			<a href="{{ route('aqua.aquariums.create') }}" class="btn btn-success">{{ __('basic.add') }}</a>
		</div>

		<div style="overflow-x:auto; -webkit-overflow-scrolling: touch;">
			<table class="table table-striped table-bordered text-center align-middle">
				<thead>
					<tr>
						<th>Название</th>
						<th>Объем</th>
						<th>Тестов</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@forelse($aquariums as $aquarium)
						<tr>
							<td>{{ $aquarium->name }}</td>
							<td>{{ $aquarium->volume ? $aquarium->volume.' л' : '—' }}</td>
							<td>{{ $aquarium->tests_count }}</td>
							<td>
								<a href="{{ route('aqua.aquariums.edit', ['id' => $aquarium->id]) }}" class="btn btn-sm btn-success">Править</a>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="4">{{ __('basic.nothings_here') }}</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
@endsection
