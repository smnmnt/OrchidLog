@extends('layouts.layout', ['title' =>  __('basic.watching')])

@section('content')
	{{-- @var \App\Models\AquaTests $test --}}

	@php
		$englishMonths = trans('months.months', [], 'en');
		$russianMonths = trans('months.months', [], 'ru');
	@endphp

	<div class="container mt-4">
		<div class="d-flex justify-content-between align-items-center mb-3">
			<h2>Тест воды {{ str_ireplace($englishMonths, $russianMonths, date('d F Y H:i', strtotime($test->tested_at))) }}</h2>
			<a href="{{ route('aqua.test.edit', ['id' => $test->id]) }}" class="btn btn-success">Править</a>
		</div>

		<div class="border rounded p-3 mb-3">
			<p class="mb-2">
				<strong>Источник:</strong>
				{{ $test->sourceLabel() }}
			</p>
			<p class="mb-2">
				<strong>Состояние:</strong>
				<span class="badge {{ $test->overallStatusBadgeClass() }}">
					{{ $test->overallStatusLabel() }}
				</span>
			</p>
			@if($test->notes)
				<p class="mb-0"><strong>Примечание:</strong> {{ $test->notes }}</p>
			@endif
		</div>

		<div style="overflow-x:auto; -webkit-overflow-scrolling: touch;">
			<table class="table table-striped table-bordered text-center align-middle">
				<thead>
					<tr>
						<th scope="col">Тип</th>
						<th scope="col">Значение</th>
						<th scope="col">Норма</th>
						<th scope="col">Состояние</th>
					</tr>
				</thead>
				<tbody>
					@forelse($test->results as $result)
						<tr>
							<td>{{ $result->type?->name ?? '—' }}</td>
							<td>{{ $result->value }} {{ $result->type?->unit }}</td>
							<td>
								@if($result->type?->value_min !== null && $result->type?->value_max !== null)
									{{ $result->type->value_min }} <br>-<br> {{ $result->type->value_max }} <br> {{ $result->type?->unit }}
								@else
									—
								@endif
							</td>
							<td>
								<span class="badge {{ $result->statusBadgeClass() }}">
									{{ $result->statusLabel() }}
								</span>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="4">Показатели пока не добавлены</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>

		<form action="{{ route('aqua.test.destroy', ['id' => $test->id]) }}"
			  class="delete-btn justify-content-end mt-4"
			  method="post"
			  onsubmit="return confirm('Удалить тест воды?');">
			@csrf
			@method('DELETE')
			<input type="submit" class="btn btn-danger" aria-label="Close" name="del-but" value="{{ __('basic.del') }}">
		</form>
	</div>
@endsection
