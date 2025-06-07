@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => __('basic.watching')])

@section('content')
    @foreach($tow as $Unit)
        <div class="card">
            <div class="card-body">
                <fieldset disabled>
                    @php
                        $UnitName   = $Unit->WateringName;
                        $UnitIcon   = $Unit->TypeOfImg;
                    @endphp
                    @include('parts.name')
                    @include('tow.parts.icon')
                </fieldset>

            <div class="card-body d-flex justify-content-around">
                <a href="{{ route('tow.edit', ['id' => $Unit->ID]) }}" class=" btn edit_btn">
                    <img src="{{ '/storage/img/pencil.svg' }}" alt="edit">
                </a>
                <form action="{{ route('tow.destroy', ['id' => $Unit->ID]) }}"
                      class="delete-btn"
                      method="post"
                      onsubmit="return confirm('{{__( 'wtr.del_type',[ 'name' => $UnitName ]) }}');">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn standart-btn" aria-label="Close" style="background-image: url({{ asset('/storage/img/trash.svg') }});" value="">
                    <!-- /.standart-btn -->
                </form>
            </div>
        </div>

        @if(isset($waterings) && sizeof($waterings))
            <table class="table table-striped table-bordered text-left align-middle mt-2">
                <thead>
                <tr>
                    <th>#</th>
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
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($watering->WateringDate)->format('d.m.Y') }}</td>
                        <td>{{ $watering->TypeOfImg ?? '—' }}</td>
                        <td>{{ $watering->FertilizerName ? ($watering->FertilizerName . ' - ' . $watering->FertilizerDoze) : '—' }}</td>
                        <td>{{ $watering->GroupName ?? __('wtr.all_p') }}</td>
                        <td>{{ $watering->FlowerCount }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    @endforeach
@endsection
