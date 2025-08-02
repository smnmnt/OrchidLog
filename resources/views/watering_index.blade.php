@extends('layouts.layout', ['title' =>  __('wtr.ds') ])

@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>{{ __('wtr.ds')  }}</h2>
        <a href="{{ route('global_watering.create') }}" class="btn btn-success">{{ __('basic.add') }}</a>
    </div>

    <div style="overflow-x:auto; -webkit-overflow-scrolling: touch;">
        <table class="table table-striped table-bordered text-center align-middle w-100" style="min-width: 600px;">
            <thead>
                <tr>
                    <th scope="col">{{ __('wtr.date') }}</th>
                    <th scope="col">{{ __('wtr.type') }}</th>
                    <th scope="col">{{ __('wtr.fert') }}</th>
                    <th scope="col">{{ __('wtr.group') }}</th>
                    <th scope="col">{{ __('wtr.count') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($waterings as $watering)
                    <tr onclick="window.location='{{ route('global_watering.show', ['id' => $watering->ID]) }}'" style="cursor: pointer;">
                        <td>{{ \Carbon\Carbon::parse($watering->WateringDate)->format('d.m.Y') }}</td>
                        <td>{{ $watering->TypeOfImg ?? '—' }}</td>
						<td>
							@if($watering->FertilizerName)
								{!! nl2br(e(
									collect(explode("\n", $watering->FertilizerName))
										->map(fn($name) => trim($name))
										->implode("\n")
								)) !!}
								@if($watering->FertilizerDoze)
									<div class="text-muted small mt-1">
										{{ $watering->FertilizerDoze }}
									</div>
								@endif
							@else
								—
							@endif
						</td>
                        <td>{{ $watering->GroupName ?? __('wtr.all_p') }}</td>
                        <td>{{ $watering->FlowerCount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
