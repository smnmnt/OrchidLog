@extends('layouts.layout', ['title' => 'Редактировать аквариум'])

@section('content')
	{{-- @var \App\Models\Aquariums $aquarium --}}

	<div class="container mt-4">
		<h2 class="mb-3">Редактировать аквариум</h2>

		<form method="POST" action="{{ route('aqua.aquariums.update', ['id' => $aquarium->id]) }}" class="form-box">
			@csrf
			@method('PATCH')

			@include('aqua.aquarium.form')
			@include('parts.submit')
		</form>

		<form action="{{ route('aqua.aquariums.destroy', ['id' => $aquarium->id]) }}"
			  class="delete-btn justify-content-end mt-4"
			  method="post"
			  onsubmit="return confirm('Удалить аквариум?');">
			@csrf
			@method('DELETE')
			<input type="submit" class="btn btn-danger" value="{{ __('basic.del') }}">
		</form>
	</div>
@endsection
