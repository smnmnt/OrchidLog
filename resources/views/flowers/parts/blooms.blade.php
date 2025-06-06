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
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @php $i = 0; @endphp
                @foreach($blooms as $bloom)
                    @php $i++ @endphp
                    <tr>
                        <th scope="row"> {{$i}}</th>
                        <td>{{ str_ireplace($nmeng, $nmrus, date('d F Y', strtotime($bloom->BB))) }}</td>
                        <td>
                            @if($bloom->BE)
                                {{ str_ireplace($nmeng, $nmrus, date('d F Y', strtotime($bloom->BE))) }}
                            @else
                                ----
                            @endif
                            </td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                </button>
                                <ul class="dropdown-menu" style="min-width: 0">
                                    <li>
                                        <a class="dropdown-item d-flex justify-content-center" style="padding: 0.25rem 0.35rem;" href="{{ route('flowers.blooms.edit', ['id' => $bloom->ID]) }}">
                                            <img src="{{ '/storage/img/pencil.svg' }}" style="padding: 6px" alt="edit">
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('flowers.blooms.destroy', ['id' => $bloom->ID]) }}"
                                              class="delete-btn dropdown-item"
                                              style="padding: 0.25rem 0.35rem;"
                                              method="post"
                                              @if($bloom->BE)
                                                  onsubmit="return confirm('{{ __('bloom.del_d', ['date1' => date('d.m.Y', strtotime($bloom->BB)), 'date2' => date('d.m.Y', strtotime($bloom->BE)) ]) }}');"
                                                @else
                                                  onsubmit="return confirm('{{ __('bloom.del_d_b', ['date1' => date('d.m.Y', strtotime($bloom->BB))]) }}');"
                                              @endif
                                        >
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
                                    </li>
                                </ul>
                            </div>
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
