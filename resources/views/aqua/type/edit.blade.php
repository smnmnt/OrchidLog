@extends('layouts.layout', ['title' => 'Редактировать тип теста'])

@section('content')
	{{-- @var \App\Models\AquaTestTypes $type --}}

	<div class="container mt-4">
		<h2 class="mb-3">Редактировать тип теста</h2>

		<form method="POST" action="{{ route('aqua.types.update', ['id' => $type->id]) }}" class="form-box">
			@csrf
			@method('PATCH')

			@include('aqua.type.form')
			@include('parts.submit')
		</form>

		<form action="{{ route('aqua.types.destroy', ['id' => $type->id]) }}"
			  class="delete-btn justify-content-end mt-4"
			  method="post"
			  onsubmit="return confirm('Удалить тип теста?');">
			@csrf
			@method('DELETE')
			<input type="submit" class="btn btn-danger" value="{{ __('basic.del') }}">
		</form>
	</div>
@endsection
