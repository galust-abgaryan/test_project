@extends('layouts.app')

@section('content')

	@php
		$currentRouteName = Route::currentRouteName();
		$storeRouteName = str_replace('create', 'store', $currentRouteName);
		$title = humanize(\Illuminate\Support\Str::singular($resource)) . ' Show Page';
	@endphp

	@include('partials.crud.title', ['title' => $title])

	@if($item)
		@includeFirst($showPartials)
	@else
		@include('partials.crud.not-found', ['title' => $title])
	@endif
@endsection
