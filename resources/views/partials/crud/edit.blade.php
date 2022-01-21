@extends('layouts.app')

@section('content')

	@php
		$currentRouteName = Route::currentRouteName();
		$storeRouteName = str_replace('edit', 'update', $currentRouteName);
		$title = 'Update ' . humanize(\Illuminate\Support\Str::singular($resource));
	@endphp

	@if($item)
		@include('partials.crud.title', ['title' => $title])
		@includeFirst($formPartials, ['route' => [$storeRouteName, $item->getKey()]])
	@else
		Item not found
	@endif

@endsection
