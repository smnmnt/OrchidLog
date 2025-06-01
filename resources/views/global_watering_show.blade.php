@extends('layouts.layout', ['title' => 'Полив от '. $waterings->first()->WateringDate])

@section('content')

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Полив от {{$waterings->first()->WateringDate}}</h2>
            <a href="{{ route('global_watering.edit', ['id' => $waterings->first()->ID]) }}" class="btn btn-success">Редактировать полив</a>
        </div>

        <table class="table table-striped table-bordered text-left align-middle">
            <thead>
            <tr>
                <th scope="col">Растение</th>
            </tr>
            </thead>
            <tbody>
            @foreach($flowers as $flower)
                <tr>
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
