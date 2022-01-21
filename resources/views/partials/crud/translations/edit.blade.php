@extends('layouts.app')

@section('content')

	@php
		$currentRouteName = Route::currentRouteName();
		$updateRouteName = str_replace('edit', 'update', $currentRouteName);
		$showTransModel = str_replace('translations.edit', 'show', $currentRouteName);
		$title = 'Update ' . humanize(\Illuminate\Support\Str::singular($resource));
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
			'route' => array_merge([$updateRouteName], $routeParams)
		]
	)
@endsection
