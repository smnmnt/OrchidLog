@extends('layouts.layout', ['title' => __('basic.watching')])

@section('content')
    @foreach($disease as $Unit)
        <div class="card">
            <div class="card-body">
                <fieldset disabled>
                    @php
                        $UnitName   = $Unit->Name;
                        $UnitDesc   = $Unit->Desc;
                        $UnitMOT    = $Unit->MOT;
                    @endphp
                    @include('parts.name')
                    @include('parts.desc')
                    @include('parts.mot')
                </fieldset>
            </div>
            <div class="card-body d-flex justify-content-around">
                <a href="{{ route('diseases.edit', ['id' => $Unit->ID]) }}" class=" btn edit_btn">
                    <img src="{{ '/storage/img/pencil.svg' }}" alt="edit">
                </a>
                <form action="{{ route('diseases.destroy', ['id' => $Unit->ID]) }}"
                      class="delete-btn"
                      method="post"
                      onsubmit="return confirm('{{ __('disease.del_d', ['name' => $Unit->Name]) }}');">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger standart-btn btn-close" aria-label="Close" value="">
                    <!-- /.standart-btn -->
                </form>
            </div>
        </div>
        @if(isset($flowers) && sizeof($flowers))
            <table class="table table-striped table-bordered text-left align-middle mt-2">
                <thead>
                <tr>
                    <th scope="col">{{ __('flower.d') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($flowers as $flower)
                    <tr onclick="window.location='{{ route('flowers.show', ['id' => $flower->FlowerID]) }}'" style="cursor: pointer;">
                        <td>{{ $flower->Name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    @endforeach
@endsection
