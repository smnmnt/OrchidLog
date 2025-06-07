@include('parts.nameLimiter')

@extends('layouts.layout', ['title' => __('basic.watching')])

@section('content')
    @foreach($placement as $Unit)
        <div class="card">
            <div class="card-body">
                <fieldset disabled>
                    @php
                        $UnitName   = $Unit->Name;
                    @endphp
                    @include('parts.name')
                </fieldset>
            </div>
            <div class="card-body d-flex justify-content-around">
                <a href="{{ route('placements.edit', ['id' => $Unit->ID]) }}" class=" btn edit_btn">
                    <img src="{{ '/storage/img/pencil.svg' }}" alt="edit">
                </a>
                <form action="{{ route('placements.destroy', ['id' => $Unit->ID]) }}"
                      class="delete-btn"
                      method="post"
                      onsubmit="return confirm('{{ __('flower.del_plc', ['name' => $Unit->Name]) }}');">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn standart-btn" aria-label="Close" style="background-image: url({{ asset('/storage/img/trash.svg') }});" value="">
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
