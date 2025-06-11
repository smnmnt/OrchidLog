@extends('layouts.layout', ['title' =>  __('flower.edit_d')])

@section('content')
    @foreach($flowers as $Unit) @endforeach
    <form action="{{ route('flowers.update', ['id' => $Unit->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $UnitName   = $Unit->Name;
            $UnitDOB    = $Unit->DOB;
            $UnitSize    = $Unit->Size;
            $UnitNotes    = $Unit->Notes;
        @endphp
        @include('parts.flower_name_edit')
        @include('parts.dob')
        @include('parts.size')
        @include('parts.notes')
        @include('parts.shop')
        @include('parts.wrid')
        @include('parts.placement')
        @include('parts.submit')
    </form>
@endsection
