@extends('layouts.app')

@section('content')
	@php
		$currentRouteName = Route::currentRouteName();
		$updateRouteName = str_replace('edit', 'update', $currentRouteName);
		$title = 'Update ' . humanize(\Illuminate\Support\Str::singular($resource));
	@endphp

    @include('partials.crud.title', ['title' => $title])
    @includeFirst($formPartials, ['route' => $updateRouteName])


@endsection
