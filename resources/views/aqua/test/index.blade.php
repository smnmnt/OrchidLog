@extends('layouts.layout', ['title' =>  "Тесты" ])

@section('content')

	@php
		$englishMonths = trans('months.months', [], 'en');
		$russianMonths = trans('months.short_months', [], 'ru');
	@endphp
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Тесты</h2>
        <a href="{{ route('aqua.test.create') }}" class="btn btn-success">{{ __('basic.add') }}</a>
    </div>

	<div class="d-flex gap-2 mb-3">
		<a href="{{ route('aqua.aquariums') }}" class="btn btn-outline-success btn-sm">Аквариумы</a>
		<a href="{{ route('aqua.types') }}" class="btn btn-outline-success btn-sm">Типы тестов</a>
	</div>

    <div style="overflow-x:auto; -webkit-overflow-scrolling: touch;">
		@if($tests->count())
			<table class="table table-striped table-bordered text-center align-middle w-100">
				<thead>
				<tr>
					<th scope="col" style="width: 1.2rem;">Дата</th>
					<th scope="col">Источник</th>
					<th scope="col">Состояние</th>
				</tr>
				</thead>
				<tbody>
				{{-- @var \App\Models\AquaTests $test --}}
				@foreach($tests as $test)
					<tr onclick="window.location='{{ route('aqua.test.show', ['id' => $test->id]) }}'" style="cursor: pointer;">
						<td>{{ str_ireplace($englishMonths, $russianMonths, date('d F Y', strtotime($test->tested_at))) }}</td>
						<td>
							{{ $test->sourceLabel() }}
						</td>
						<td>
							<span class="badge {{ $test->overallStatusBadgeClass() }}">
								{{ $test->overallStatusLabel() }}
							</span>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		@endif
    </div>
</div>
@endsection
