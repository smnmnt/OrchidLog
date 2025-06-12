@extends('layouts.layout', ['title' => __('wtr.edit_d')])

@section('content')
    <form action="{{ route('flowers.blooms.update', ['id' => $bloom->ID]) }}" method="post" class="form-box" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        @php
            $BloomBB    = $bloom->BB;
            $BloomBE    = $bloom->BE;
            $Peduncle   = $bloom->peduncle;
        @endphp
        @include('flowers.parts.blooms.BB')
        @include('flowers.parts.blooms.BE')
		@include('flowers.parts.blooms.peduncle')
        @include('parts.submit')
    </form>


	<form action="{{ route('flowers.blooms.destroy', ['id' => $bloom->ID]) }}"
		  class="btn delete-btn justify-content-end"
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
		<input type="submit" class="btn btn-danger" aria-label="Close" name="del-but" value="{{ __('basic.del') }}">
	</form>

@endsection
