@extends('layouts.layout', ['title' => 'Полив'])

@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>История поливов</h2>
        <a href="{{ route('global_watering.create') }}" class="btn btn-success">Добавить полив</a>
    </div>

    <div style="overflow-x:auto; -webkit-overflow-scrolling: touch;">
        <table class="table table-striped table-bordered text-center align-middle w-100" style="min-width: 600px;">
            <thead>
                <tr>
                    <th scope="col">Дата</th>
                    <th scope="col">Тип</th>
                    <th scope="col">Удобрение</th>
                    <th scope="col">Группа</th>
                    <th scope="col">Кол-во растений</th>
                </tr>
            </thead>
            <tbody>
                @foreach($waterings as $watering)
                    <tr onclick="window.location='{{ route('global_watering.show', ['id' => $watering->ID]) }}'" style="cursor: pointer;">
                        <td>{{ \Carbon\Carbon::parse($watering->WateringDate)->format('d.m.Y') }}</td>
                        <td>{{ $watering->WateringName ?? '—' }}</td>
                        <td>{{ $watering->FertilizerName ? ($watering->FertilizerName . ' - ' . $watering->FertilizerDoze) : '—' }}</td>
                        <td>{{ $watering->GroupName ?? 'Все растения' }}</td>
                        <td>{{ $watering->FlowerCount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
{{--@if(isset($fertilizers) && sizeof($fertilizers))--}}
{{--    @foreach($fertilizers as $fertilizer)--}}
{{--        {{$fertilizer->FertilizerName}}--}}
{{--    @endforeach--}}
{{--@else--}}
{{--    NAnnnn--}}
{{--@endif--}}
