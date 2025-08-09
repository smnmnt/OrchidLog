<p class="h5 mt-2">{{ __('wtr.ds') }}</p>
{{--<li class="list-group-item mb-5"><a href="{{route('flowers.waterings.create', ['id' => $Unit->ID]) }}" class="link-primary">{{ __('basic.add') }}</a></li>--}}
@if(isset($waterings) && sizeof($waterings))
    <div style="overflow-x:auto; -webkit-overflow-scrolling: touch;">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" class="table_blooms_40pr">{{ __('wtr.type') }}</th>
                <th scope="col" class="table_blooms_40pr">{{ __('wtr.fert') }}</th>
                <th scope="col" class="table_blooms_40pr">{{ __('wtr.date') }}</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @php $i = 0; @endphp
                @foreach($waterings as $watering)
                    @php $i++ @endphp
                    <tr>
                        <th scope="row"> {{$i}}</th>
                        <td  onclick="window.location='{{ route('global_watering.show', ['id' => $watering->ID]) }}'">
                            @foreach($TOW as $TOW_el)
                                @if($TOW_el->ID == $watering->TypeID)
                                    {{$TOW_el->WateringName}}
                                @endif
                            @endforeach
                        </td>
                        <td  onclick="window.location='{{ route('global_watering.show', ['id' => $watering->ID]) }}'">
							@php
								$fertilizerId = json_decode($watering->FertilizerID)[0] ?? null;
								$fertilizer_elId = null;
							@endphp
                            @foreach($fertilizers as $fertilizers_el)
								@if($fertilizers_el->ID == $fertilizerId)
									@php
										$fertilizer_elId = $fertilizers_el->ID;
										$fertilizer_name = $fertilizers_el->Name;

									@endphp
								@endif
                            @endforeach
							@if($fertilizer_elId)
								{!! nl2br(e(
									collect(explode("\n", $fertilizer_name))
										->map(fn($name) => trim($name))
										->implode("\n")
								)) !!}
								@if($watering->FertilizerDoze)
									<div class="text-muted small mt-1">
										{{ $watering->FertilizerDoze }}
									</div>
								@endif
							@else
								---
							@endif
                        </td>
						@php
							$englishMonths = trans('months.months', [], 'en');
							$russianMonths = trans('months.short_months', [], 'ru');
						@endphp
                        <td  onclick="window.location='{{ route('global_watering.show', ['id' => $watering->ID]) }}'">{{ str_ireplace($englishMonths, $russianMonths, date('d F Y', strtotime($watering->WateringDate))) }}</td>
                        <td>

                            <form action="{{ route('global_watering.destroy_link', ['WateringId' => $watering->ID, 'id' => $flowers->first()->ID]) }}"
                                  class="delete-btn dropdown-item"
                                  style="padding: 0.25rem 0.35rem;"
                                  method="post"
                                  onsubmit="return confirm('{{ __('wtr.del_d_u', ['name' => $watering->WateringDate]) }}');">
                                @csrf
                                @method('DELETE')
                                <label class="w-100" for="delete_btn_bloom{{$i}}">
                                    <input type="submit"
                                           class="btn standart-btn w-100"
                                           name="delete_btn_bloom{{$i}}"
                                           aria-label="Close"
                                           style="background-image: url({{ asset('/storage/img/trash.svg') }});"
                                           value="">
                                </label>
                            </form>
{{--                            <div class="btn-group">--}}
{{--                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                                </button><ul class="dropdown-menu" style="min-width: 0">--}}
{{--                                    <li>--}}
{{--                                        <a class="dropdown-item d-flex justify-content-center" style="padding: 0.25rem 0.35rem;" href="{{ route('flowers.waterings.edit', ['id' => $watering->ID]) }}">--}}
{{--                                            <img src="{{ '/storage/img/pencil.svg' }}" style="padding: 6px" alt="edit">--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li><hr class="dropdown-divider"></li>--}}
{{--                                    <li>--}}
{{--                                        <form action="{{ route('flowers.waterings.destroy', ['id' => $watering->ID]) }}"--}}
{{--                                              class="delete-btn dropdown-item"--}}
{{--                                              style="padding: 0.25rem 0.35rem;"--}}
{{--                                              method="post"--}}
{{--                                              onsubmit="return confirm('{{ __('wtr.del_d', ['name' => $watering->WateringDate]) }}');">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                            <label class="w-100" for="delete_btn_bloom{{$i}}">--}}
{{--                                                <input type="submit"--}}
{{--                                                       class="btn standart-btn w-100"--}}
{{--                                                       name="delete_btn_bloom{{$i}}"--}}
{{--                                                       aria-label="Close"--}}
{{--                                                       style="background-image: url({{ asset('/storage/img/trash.svg') }});"--}}
{{--                                                       value="">--}}
{{--                                            </label>--}}
{{--                                        </form>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
