@extends('layouts.' . $layout)

@section('content')

	@php
		$currentRouteName = Route::currentRouteName();
		$storeRouteName = str_replace('create', 'store', $currentRouteName);
		$showTransModel = str_replace('translations.create', 'show', $currentRouteName);
		$title = 'Create ' . humanize(\Illuminate\Support\Str::singular($resource));
		$routeParams = Route::current()->parameters();
	@endphp

	@if (Route::has($showTransModel))
		@include('partials.crud.title', ['title' => $title, 'link' => [
			'route' => route($showTransModel, $translatable->getKey()),
			'label' => __('Go :to', ['to' => $translatable->main_descriptive]),
		]])
	@else
		@include('partials.crud.title', ['title' => $title])
	@endif

	@includeFirst(
		$formPartials,
		[
			'route' => array_merge([$storeRouteName], $routeParams)
		]
	)
@endsection
