@extends('layouts.layout', ['title' => __('basic.lookout')])
{{-- {{ __('.ds') }} --}}
@section('content')
    <ul class="list-group">
        @isset($flowers)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('flowers.index') }}" class="adding-list-link">{{ __('flower.ds') }}</a>
                <span class="badge bg-primary rounded-pill">{{sizeof($flowers)}}</span>
            </li>
        @endisset
        @isset($fertilizers)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ route('fertilizers.index') }}" class="adding-list-link">{{ __('fert.ds') }}</a>
                <span class="badge bg-primary rounded-pill">{{sizeof($fertilizers)}}</span>
            </li>
        @endisset
            @isset($soils)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('soils.index') }}" class="adding-list-link">{{ __('tp.s_ds') }}</a>
                    <span class="badge bg-primary rounded-pill">{{sizeof($soils)}}</span>
                </li>
            @endisset
            @isset($diseases)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('diseases.index') }}" class="adding-list-link">{{ __('disease.ds') }}</a>
                    <span class="badge bg-primary rounded-pill">{{sizeof($diseases)}}</span>
                </li>
            @endisset
            @isset($placements)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('placements.index') }}" class="adding-list-link">Места</a>
                    <span class="badge bg-primary rounded-pill">{{sizeof($placements)}}</span>
                </li>
            @endisset
            @isset($shops)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('shops.index') }}" class="adding-list-link">Магазины</a>
                    <span class="badge bg-primary rounded-pill">{{sizeof($shops)}}</span>
                </li>
            @endisset
            @isset($watering_reqs)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('watering_reqs.index') }}" class="adding-list-link">Требования к поливу</a>
                    <span class="badge bg-primary rounded-pill">{{sizeof($watering_reqs)}}</span>
                </li>
            @endisset
            @isset($top)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('top.index') }}" class="adding-list-link">{{ __('tp.t_ds') }}</a>
                    <span class="badge bg-primary rounded-pill">{{sizeof($top)}}</span>
                </li>
            @endisset
            @isset($tow)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('tow.index') }}" class="adding-list-link">{{ __('wtr.n_d_ds') }}</a>
                    <span class="badge bg-primary rounded-pill">{{sizeof($tow)}}</span>
                </li>
            @endisset
            @isset($wg)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('wg.index') }}" class="adding-list-link">Группа обработки</a>
                    <span class="badge bg-primary rounded-pill">{{sizeof($wg)}}</span>
                </li>
            @endisset

    </ul>
@endsection
