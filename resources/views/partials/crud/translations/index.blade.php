@extends('layouts.' . $layout)

@section('content')
	@php
		$currentRouteName = $currentRouteName ?? Route::currentRouteName();
		$showTransModel = str_replace('translations.index', 'show', $currentRouteName);
		$title = humanize(\Illuminate\Support\Str::singular($resource)).  ' Translations List';
	@endphp

	@if ($translatable)
		@if (Route::has($showTransModel))
			@include('partials.crud.title', ['title' => $title, 'link' => [
				'route' => route($showTransModel, $translatable->getKey()),
				'label' => __('Go :to', ['to' => $translatable->main_descriptive]),
			]])
		@else
			@include('partials.crud.title', ['title' => $title . $translatable->main_descriptive])
		@endif

		@if($addTranslations)
			@include('partials.crud.add', ['label' => __('Add :resource Translation', ['resource' => humanize(\Illuminate\Support\Str::singular($resource))])])
		@endif
		@include('partials.crud.paginateable', ['noItemMessage'  => __('No :title', ['title' => $title] )])
	@else
		@include('partials.crud.not-found', ['noItemMessage'  => __('No :title', ['title' => humanize(\Illuminate\Support\Str::singular($resource))] )])
	@endif

@endsection

