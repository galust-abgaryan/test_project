<p class="text-center border rounded">
	@isset($noItemMessage)
		{!! $noItemMessage !!}
	@else
		@lang('No :resource', ['resource' => humanize($resource)])
	@endif
</p>
