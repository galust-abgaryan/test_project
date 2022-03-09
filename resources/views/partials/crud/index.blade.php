@extends('layouts.' . $layout)



@section('content')
	@php
		$currentRouteName = $currentRouteName ?? Route::currentRouteName();
	@endphp

	@include('partials.crud.title', ['title' => humanize($resource).  ' List'])

	@include('partials.crud.add')

	@include('partials.crud.paginateable')
@endsection

