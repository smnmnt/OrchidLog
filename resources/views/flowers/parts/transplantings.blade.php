<p class="h5 mt-2">{{ __('tp.ds') }}</p>
<li class="list-group-item mb-5"><a href="{{route('flowers.transplantings.create', ['id' => $Unit->ID]) }}" class="link-primary">{{ __('basic.add') }}</a></li>
@if(isset($transplantings) && sizeof($transplantings))
    <div style="overflow-x:auto; -webkit-overflow-scrolling: touch;">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" class="table_blooms_40pr">{{ __('tp.soil') }}</th>
                <th scope="col" class="table_blooms_40pr">{{ __('tp.top') }}</th>
                <th scope="col" class="table_blooms_40pr">{{ __('tp.sop') }}</th>
                <th scope="col" class="table_blooms_40pr">{{ __('tp.dot') }}</th>
            </tr>
            </thead>
            <tbody>
            @php $i = 0; @endphp
            @foreach($transplantings as $transplanting)
                @php $i++ @endphp
				<tr onclick="window.location='{{ route('flowers.transplantings.edit', ['id' => $transplanting->ID]) }}'" style="cursor: pointer; padding: 1rem">
                    <th scope="row"> {{$i}}</th>
                    <td>
                        @foreach($st_l as $st_l_el)
                            @if($st_l_el->TPID == $transplanting->ID)
                                {{$st_l_el->Name}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($TOP as $TOP_el)
                            @if($TOP_el->ID == $transplanting->TOPID)
                                {{$TOP_el->Name}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{$transplanting->SOP}}</td>
					@php
						$englishMonths = trans('months.months', [], 'en');
						$russianMonths = trans('months.short_months', [], 'ru');
					@endphp
                    <td>{{ $transplanting->DOT ? (str_ireplace($englishMonths, $russianMonths, date('d F Y', strtotime($transplanting->DOT)))) : "Без даты" }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif
