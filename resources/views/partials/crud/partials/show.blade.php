<a href="{{ request()->getUri()}}/edit" class="btn btn-primary">Edit {{ humanize(\Illuminate\Support\Str::singular($resource)) }}</a>
<br>
<br>
<div class="row">
	@foreach($array ?? $item->toArray() as $key => $value)
        @php
            $key = humanize($key);
        @endphp
		@if(is_array($value))
			@if(! empty($value))
				<div class="col-sm-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
								<div class="col-sm-3 border">
									{{$key}}:
								</div>
								<div class="col-sm-9 border">
									@include('partials.crud.partials.show', ['array' => $value, 'count' => 12])
								</div>
							</div>
						</div>
					</div>
				</div>
			@endif
		@else
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-sm-3 border">
								{!! strlen($key) > 24 ? "<span title='" . $key . "'>" . substr($key, 0, 21) . "...</span>" : $key!!}:
							</div>
							<div class="col-sm-9 border">
								{!! $value !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		@endif
	@endforeach
</div>
