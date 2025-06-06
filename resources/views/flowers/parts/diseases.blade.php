<p class="h5 mt-2">{{ __('disease.ds') }}</p>
<li class="list-group-item mb-5"><a href="{{route('flowers.diseases.create', ['id' => $Unit->ID]) }}" class="link-primary">{{ __('basic.add') }}</a></li>
@if(isset($diseases) && sizeof($diseases))
    <div style="overflow-x:auto; -webkit-overflow-scrolling: touch;">
        <table class="table table-striped table-bordered text-center align-middle">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" class="table_blooms_40pr">{{ __('basic.name') }}</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @php $i = 0; @endphp
            @foreach($diseases as $disease)
                @php $i++ @endphp
                <tr>
                    <th scope="row"> {{$i}}</th>
                    <td>{{$disease->Name}}</td>
                    <td>
                        <form action="{{ route('flowers.diseases.destroy', ['id' => $disease->ID]) }}"
                              class="delete-btn dropdown-item"
                              style="padding: 0.25rem 0.35rem;"
                              method="post"
                              onsubmit="return confirm('{{ __('disease.del_d_f', ['name' => $disease->Name]) }}');">
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
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif
