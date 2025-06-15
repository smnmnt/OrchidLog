@extends('layouts.layout', ['title' => __('wtr.d')])

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('global_watering.store') }}" class="form-box" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label for="WateringDate" class="form-label">{{ __('wtr.wd') }}</label>
				<input type="date" class="form-control" name="WateringDate" id="WateringDate" required>
            </div>
            <div class="row mb-3">
                <label for="TypeID" class="form-label">{{ __('wtr.name_d') }}</label>
				<select class="form-control" name="TypeID" id="TypeID" required>
					@foreach($types as $type)
						<option value="{{ $type->ID }}">{{ $type->WateringName }}</option>
					@endforeach
				</select>
            </div>
            <div class="row mb-3">
                <label for="FertilizerID" class="form-label">{{ __('wtr.fert') }}</label>
				<select class="form-control" name="FertilizerID" id="FertilizerID">
					<option value="">—</option>
					@foreach($fertilizers as $fertilizer)
						<option value="{{ $fertilizer->ID }}">{{ $fertilizer->Name }}</option>
					@endforeach
				</select>
			</div>
            <div class="row mb-3">
                <label for="FertilizerDoze" class="form-label">{{ __('wtr.doze') }} </label>
				<input type="text" class="form-control" name="FertilizerDoze" id="FertilizerDoze" placeholder="{{ __('wtr.doze') }}">
			</div>
            <div class="row mb-3">
                <label for="GroupID" class="form-label">{{ __('wtr.wg') }}</label>
				<select class="form-control" name="GroupID" id="GroupID">
					<option value="">{{ __('wtr.all_p') }}</option>
					@foreach($groups as $group)
						<option value="{{ $group->ID }}">{{ $group->Name }}</option>
					@endforeach
				</select>

			</div>
            @include('parts.submit')
        </form>
    </div>
@endsection
