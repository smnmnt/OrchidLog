@extends('layouts.layout', ['title' =>  __('basic.watching')])

@section('content')

	@php
		$englishMonths = trans('months.months', [], 'en');
		$russianMonths = trans('months.months', [], 'ru');
	@endphp
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>{{ __('wtr.d') }} {{ str_ireplace($englishMonths, $russianMonths, date('d F Y', strtotime($watering->WateringDate))) }}</h2>
            <a href="{{ route('global_watering.edit', ['id' => $watering->ID]) }}" class="btn btn-success">{{ __('wtr.edit_d') }}</a>
        </div>

		<div class="border rounded p-2 mb-2">
			<strong>Химия:</strong>
			@if(!$fertilizerNames->isEmpty())
				<ul class="list-disc list-inside">
					@foreach($fertilizerNames as $name)
						<li>{{ $name }}</li>
					@endforeach
				</ul>
			@else
				Без химии
			@endif

			@if($watering->FertilizerDoze)
				<p class="mt-2"><strong>Примечание:</strong> {{ $watering->FertilizerDoze }}</p>
			@endif
		</div>

		<div class="border rounded p-2 mb-2">
			<strong>Тип:</strong>
			@if(!$type->isEmpty())
				{{$type->first()->TypeOfImg}} {{$type->first()->WateringName}}
			@else
				Без типа
			@endif

			@if($watering->FertilizerDoze)
				<p class="mt-2"><strong>Примечание:</strong> {{ $watering->FertilizerDoze }}</p>
			@endif
		</div>
        <table class="table table-striped table-bordered text-left align-middle">
            <thead>
            <tr>
                <th scope="col">{{ __('flower.ds') }}:
					@if($flowers->isEmpty())
						Пока не добавлены
					@else
				</th>
            </tr>
            </thead>
            <tbody>
				@foreach($flowers as $flower)
					<tr onclick="window.location='{{ route('flowers.show', ['id' => $flower->ID]) }}'" style="cursor: pointer;">
						<td>{{ $flower->Name }}</td>
					</tr>
				@endforeach
			@endif
            </tbody>
        </table>
    </div>
@endsection
{{--@if(isset($fertilizers) && sizeof($fertilizers))--}}
{{--    @foreach($fertilizers as $fertilizer)--}}
{{--        {{$fertilizer->FertilizerName}}--}}
{{--    @endforeach--}}
{{--@else--}}
{{--    NAnnnn--}}
{{--@endif--}}
