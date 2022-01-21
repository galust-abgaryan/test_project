@extends('layouts.app')

@section('content')

	@php
		$currentRouteName = Route::currentRouteName();
		$storeRouteName = str_replace('create', 'store', $currentRouteName);
		$title = 'Create ' . humanize(\Illuminate\Support\Str::singular($resource));
	@endphp

	@include('partials.crud.title', ['title' => $title])

	@includeFirst($formPartials, ['route' => $storeRouteName])

@endsection
