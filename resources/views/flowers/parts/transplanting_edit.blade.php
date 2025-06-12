@extends('layouts.layout', ['title' => __('tp.edit_d')])

@section('content')
    <form action="{{ route('flowers.transplantings.update', ['id' => $transplanting->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $SOP        = $transplanting->SOP;
            $DOT        = $transplanting->DOT;
        @endphp
        @include('flowers.parts.transplantings.type')
        @include('flowers.parts.transplantings.soil')
        @include('flowers.parts.transplantings.SOP')
        @include('flowers.parts.transplantings.date')
{{--        @foreach($old_soils_ids->all() as $a)--}}
{{--            <br>{{$a}}<br>--}}
{{--        @endforeach--}}
        @include('parts.submit')
    </form>


	<form action="{{ route('flowers.transplantings.destroy', ['id' => $transplanting->ID]) }}"
		  class="btn delete-btn justify-content-end"
		  style="padding: 0.25rem 0.35rem;"
		  method="post"
		  onsubmit="return confirm('{{ __('tp.del_d_f', ['name' => $transplanting->DOT]) }}');">
		@csrf
		@method('DELETE')
		<input type="submit" class="btn btn-danger" aria-label="Close" name="del-but" value="{{ __('basic.del') }}">
	</form>
@endsection
