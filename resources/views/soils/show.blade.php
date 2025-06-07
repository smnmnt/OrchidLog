@extends('layouts.layout', ['title' =>  __('basic.watching') ])

@section('content')
    @foreach($soil as $Unit)
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
                <a href="{{ route('soils.edit', ['id' => $Unit->ID]) }}" class=" btn edit_btn">
                    <img src="{{ '/storage/img/pencil.svg' }}" alt="edit">
                </a>
                <form action="{{ route('soils.destroy', ['id' => $Unit->ID]) }}"
                      class="delete-btn"
                      method="post"
                      onsubmit="return confirm('{{ __('tp.del_soil', ['name' => $Unit->Name]) }}');">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn standart-btn" aria-label="Close" style="background-image: url({{ asset('/storage/img/trash.svg') }});" value="">
                    <!-- /.standart-btn -->
                </form>
            </div>
        </div>
        @if(isset($tps) && sizeof($tps))
            <div class="table-responsive mt-2">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th scope="col">{{ __('flower.d') }}</th>
                        <th scope="col">{{ __('tp.top') }}</th>
                        <th scope="col">{{ __('tp.dot') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tps as $tp)
                        <tr onclick="window.location='{{ route('flowers.show', ['id' => $tp->FlowerID]) }}'" style="cursor: pointer;">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tp->Name ?? '—' }}</td>
                            <td>{{ $tp->TypeName ?? '—' }}</td>
                            <td>{{ \Carbon\Carbon::parse($tp->DOT)->format('d.m.Y') }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        @endif
    @endforeach
@endsection
