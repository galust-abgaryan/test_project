
<div class="row">
	<div class="col-sm-12">
		<h1>
			{{$title}}
			@isset($link)
				<a href="{{ $link['route'] }}">{{ $link['label'] }}</a>
			@endisset
		</h1>
		<hr>
	</div>
</div>
