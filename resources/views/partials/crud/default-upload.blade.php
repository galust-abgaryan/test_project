@extends('layouts.app')

@section('content')

	@php
		$currentRouteName = Route::currentRouteName();
		$storeRouteName = str_replace('edit', 'update', $currentRouteName);
		$title = humanize(\Illuminate\Support\Str::singular($resource)) . ' Upload Default';
	@endphp

	{{ Form::model($item ?? null, ['route' => $storeRouteName, 'method' => isset($item) ? "PUT" : "POST",  'files' => true]) }}

	@foreach($uploadable as $col)
		{{ Form::bsFile($col, ['label' => 'Upload Default ' . humanize(str_replace('_path', '', $col)), 'src' => $model->getDefaultUploadUrl($col)]) }}
	@endforeach

	{{ Form::bsSubmit($title, ['class' => 'btn btn-default']) }}

	{{ Form::close() }}
@endsection
