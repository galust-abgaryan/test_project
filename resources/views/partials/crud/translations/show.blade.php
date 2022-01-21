@extends('layouts.app')

@section('content')

	@php
		$currentRouteName = Route::currentRouteName();
		$storeRouteName = str_replace('create', 'store', $currentRouteName);
		$showTransModel = str_replace('translations.show', 'show', $currentRouteName);
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

	@if($item)
		@includeFirst($showPartials)
	@else
		@include('partials.crud.not-found', ['title' => $title])
	@endif
@endsection
