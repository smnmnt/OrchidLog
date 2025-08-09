<p class="h5 mt-2">Цветения</p>
<li class="list-group-item mb-5"><a href="{{route('flowers.blooms.create', ['id' => $Unit->ID]) }}" class="link-primary">{{ __('basic.add') }}</a></li>
@if(isset($blooms) && sizeof($blooms))
    <div style="overflow-x:auto; -webkit-overflow-scrolling: touch;">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" class="table_blooms_40pr">{{ __('bloom.b') }}</th>
                <th scope="col" class="table_blooms_40pr">{{ __('bloom.e') }}</th>
				<th scope="col" class="table_blooms_40pr">{{ __('bloom.peduncle') }}</th>
            </tr>
            </thead>
            <tbody>
            @php $i = 0; @endphp
                @foreach($blooms as $bloom)
                    @php $i++ @endphp
					<tr onclick="window.location='{{ route('flowers.blooms.edit', ['id' => $bloom->ID]) }}'" style="cursor: pointer; padding: 1rem">
                        <th scope="row"> {{$i}}</th>
						@php
							$englishMonths = trans('months.months', [], 'en');
							$russianMonths = trans('months.months', [], 'ru');
						@endphp
                        <td>{{ str_ireplace($englishMonths, $russianMonths, date('d F Y', strtotime($bloom->BB))) }}</td>
                        <td>
                            @if($bloom->BE)
                                {{ str_ireplace($englishMonths, $russianMonths, date('d F Y', strtotime($bloom->BE))) }}
                            @else
                                ----
                            @endif
						</td>
						<td>
							@if($bloom->peduncle)
								{{ __('basic.new') }}
							@else
								{{ __('basic.old') }}
							@endif
						</td>
                    </tr>
                @endforeach

        {{--    <tr>--}}
        {{--        <th scope="row">2</th>--}}
        {{--        <td>31.01.25</td>--}}
        {{--        <td>----</td>--}}
        {{--        <td>----</td>--}}
        {{--    </tr>--}}
        {{--    --}}
        {{--    <tr>--}}
        {{--        <th scope="row">3</th>--}}
        {{--        <td colspan="2">Larry the Bird</td>--}}
        {{--        <td>@twitter</td>--}}
        {{--    </tr>--}}
            </tbody>
        </table>
    </div>
@endif
