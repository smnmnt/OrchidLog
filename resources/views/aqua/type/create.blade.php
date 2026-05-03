@extends('layouts.layout', ['title' => 'Добавить тип теста'])

@section('content')
	<div class="container mt-4">
		<h2 class="mb-3">Добавить тип теста</h2>

		<form method="POST" action="{{ route('aqua.types.store') }}" class="form-box">
			@csrf

			@include('aqua.type.form')
			@include('parts.submit')
		</form>
	</div>
@endsection
