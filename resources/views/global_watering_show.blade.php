@extends('layouts.layout', ['title' =>  __('basic.watching')])

@section('content')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>{{ __('wtr.d') }} {{$watering->WateringDate}}</h2>
            <a href="{{ route('global_watering.edit', ['id' => $watering->ID]) }}" class="btn btn-success">{{ __('wtr.edit_d') }}</a>
        </div>

		<div class="border rounded p-2 mb-2">
			<strong>Удобрения:</strong>
			<ul class="list-disc list-inside">
				@foreach($fertilizerNames as $name)
					<li>{{ $name }}</li>
				@endforeach
			</ul>

			@if($watering->FertilizerDoze)
				<p class="mt-2"><strong>Дозировка:</strong> {{ $watering->FertilizerDoze }}</p>
			@endif
		</div>

        <table class="table table-striped table-bordered text-left align-middle">
            <thead>
            <tr>
                <th scope="col">{{ __('flower.d') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($flowers as $flower)
				<tr onclick="window.location='{{ route('flowers.show', ['id' => $flower->ID]) }}'" style="cursor: pointer;">
					<td>{{ $flower->Name }}</td>
				</tr>
            @endforeach
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
