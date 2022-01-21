@php
	$currentRouteName = $currentRouteName ?? Route::currentRouteName();
	$addRouteName = str_replace('index', 'create', $currentRouteName);
	$hasRoute = Route::has($addRouteName);
	if ($hasRoute) {
		$route = route($addRouteName, Route::current()->parameters());
	}
	
	$uploadDefaultRouteName = str_replace('index', 'edit-upload-default', $currentRouteName);
	$hasUploadRoute = Route::has($uploadDefaultRouteName);
@endphp

@if($hasRoute || $hasUploadRoute )
	<div class="row">
		<div class="col-sm-12">
			@if($hasRoute)
				<a href="{{$route}}" class="btn btn-info" role="button">
					@isset($label)
						@lang($label)
					@else
						@lang('Add :resource', ['resource' => humanize(\Illuminate\Support\Str::singular($resource))])
					@endisset
				</a>
			@endif
			@if($hasUploadRoute)
				<a href="{{route($uploadDefaultRouteName)}}" class="btn btn-info" role="button">
					@isset($label)
						@lang($label)
					@else
						@lang('Upload Default :resource', ['resource' => humanize(\Illuminate\Support\Str::singular($resource))])
					@endisset
				</a>
			@endif
		</div>
	</div>
@endif
