<p class="h5 mt-2">Пересадки</p>
<li class="list-group-item mb-5"><a href="{{route('flowers.transplantings.create', ['id' => $Unit->ID]) }}" class="link-primary">Добавить</a></li>
@if(isset($transplantings) && sizeof($transplantings))
    <table class="table table-striped table-bordered text-center align-middle">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" class="table_blooms_40pr">Почва</th>
            <th scope="col" class="table_blooms_40pr">Тип посадки</th>
            <th scope="col" class="table_blooms_40pr">Размер горшка</th>
            <th scope="col" class="table_blooms_40pr">Дата</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @php $i = 0; @endphp
        @foreach($transplantings as $transplanting)
            @php $i++ @endphp
            <tr>
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
                <td>{{ str_ireplace($nmeng, $nmrus, date('d F Y', strtotime($transplanting->DOT))) }}</td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        </button><ul class="dropdown-menu" style="min-width: 0">
                            <li>
                                <a class="dropdown-item d-flex justify-content-center" style="padding: 0.25rem 0.35rem;" href="{{ route('flowers.transplantings.edit', ['id' => $transplanting->ID]) }}">
                                    <img src="{{ '/storage/img/pencil.svg' }}" style="padding: 6px" alt="edit">
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('flowers.transplantings.destroy', ['id' => $transplanting->ID]) }}"
                                      class="delete-btn dropdown-item"
                                      style="padding: 0.25rem 0.35rem;"
                                      method="post"
                                      onsubmit="return confirm('Удалить пересадку №{{ $i }}?');">
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
        </tbody>
    </table>
@endif
