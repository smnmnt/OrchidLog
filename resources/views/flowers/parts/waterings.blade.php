<p class="h5 mt-2">Обработки</p>
<li class="list-group-item mb-5"><a href="{{route('flowers.waterings.create', ['id' => $Unit->ID]) }}" class="link-primary">Добавить</a></li>
@if(isset($waterings) && sizeof($waterings))
    <table class="table table-striped table-bordered text-center align-middle">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" class="table_blooms_40pr">Тип</th>
            <th scope="col" class="table_blooms_40pr">Удобрение</th>
            <th scope="col" class="table_blooms_40pr">Дата</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @php $i = 0; @endphp
            @foreach($waterings as $watering)
                @php $i++ @endphp
                <tr>
                    <th scope="row"> {{$i}}</th>
                    <td>
                        @foreach($TOW as $TOW_el)
                            @if($TOW_el->ID == $watering->TypeID)
                                {{$TOW_el->WateringName}}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($fertilizers as $fertilizers_el)
                            @if($fertilizers_el->ID == $watering->FertilizerID)
                                {{$fertilizers_el->Name. " - ". $watering->FertilizerDoze}}
                            @endif
                        @endforeach
                    </td>
                    <td>{{ str_ireplace($nmeng, $nmrus, date('d F Y', strtotime($watering->WateringDate))) }}</td>
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            </button><ul class="dropdown-menu" style="min-width: 0">
                                <li>
                                    <a class="dropdown-item d-flex justify-content-center" style="padding: 0.25rem 0.35rem;" href="{{ route('flowers.waterings.edit', ['id' => $watering->ID]) }}">
                                        <img src="{{ '/storage/img/pencil.svg' }}" style="padding: 6px" alt="edit">
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('flowers.waterings.destroy', ['id' => $watering->ID]) }}"
                                          class="delete-btn dropdown-item"
                                          style="padding: 0.25rem 0.35rem;"
                                          method="post"
                                          onsubmit="return confirm('Удалить обработку №{{ $i }}?');">
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
