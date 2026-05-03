@extends('layouts.layout', ['title' => 'Добавить аквариум'])

@section('content')
	<div class="container mt-4">
		<h2 class="mb-3">Добавить аквариум</h2>

		<form method="POST" action="{{ route('aqua.aquariums.store') }}" class="form-box">
			@csrf

			@include('aqua.aquarium.form')
			@include('parts.submit')
		</form>
	</div>
@endsection
