@extends('layouts.layout', ['title' => 'Полив'])

@section('content')
    <div class="container">
        <h2>Массовый полив</h2>
        <form method="POST" action="{{ route('global_watering.store') }}">
            @csrf
            <div class="form-group">
                <label for="WateringDate">Дата полива</label>
                <input type="date" class="form-control" name="WateringDate" required>
            </div>
            <div class="form-group">
                <label for="TypeID">Тип полива</label>
                <select class="form-control" name="TypeID" required>
                    @foreach($types as $type)
                        <option value="{{ $type->ID }}">{{ $type->WateringName }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="FertilizerID">Удобрение (опционально)</label>
                <select class="form-control" name="FertilizerID">
                    <option value="">—</option>
                    @foreach($fertilizers as $fertilizer)
                        <option value="{{ $fertilizer->ID }}">{{ $fertilizer->Name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="FertilizerDoze">Дозировка удобрения</label>
                <input type="text" class="form-control" name="FertilizerDoze">
            </div>
            <div class="form-group">
                <label for="GroupID">Группа растений (необязательно)</label>
                <select class="form-control" name="GroupID">
                    <option value="">Все растения</option>
                    @foreach($groups as $group)
                        <option value="{{ $group->ID }}">{{ $group->Name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success mt-3">Полить</button>
        </form>
    </div>
@endsection
{{--@if(isset($fertilizers) && sizeof($fertilizers))--}}
{{--    @foreach($fertilizers as $fertilizer)--}}
{{--        {{$fertilizer->FertilizerName}}--}}
{{--    @endforeach--}}
{{--@else--}}
{{--    NAnnnn--}}
{{--@endif--}}
