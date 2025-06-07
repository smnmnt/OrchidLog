@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => __('basic.watching')])

@section('content')
    @foreach($fertilizer as $Unit)
        <div class="card mb-2">
            <div class="card-body">
                <fieldset disabled>
                    @php
                        $UnitName   = $Unit->Name;
                        $UnitDesc   = $Unit->Desc;
                    @endphp
                    @include('parts.name')
                    @include('parts.desc')
                </fieldset>
            </div>
            <div class="card-body d-flex justify-content-around">
                <a href="{{ route('fertilizers.edit', ['id' => $Unit->ID]) }}" class=" btn edit_btn">
                    <img src="{{ '/storage/img/pencil.svg' }}" alt="edit">
                </a>
                <form action="{{ route('fertilizers.destroy', ['id' => $Unit->ID]) }}"
                      class="delete-btn"
                      method="post"
                      onsubmit="return confirm('{{ __('fert.del_d', ['name' => $Unit->Name]) }}');">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger standart-btn btn-close" aria-label="Close" value="">
                    <!-- /.standart-btn -->
                </form>
            </div>
        </div>
        @if(isset($waterings) && sizeof($waterings))
            <div class="table-responsive">
                <table class="table table-bordered">
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
            </div>
        @endif
    @endforeach
@endsection
