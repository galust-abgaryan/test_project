
<div class="row">
	<div class="col-lg-12" >
		@include('partials.crud.search')
		@if ($items->count())
			<h1> Total {{ $items->total() }}</h1>
			<div class="table-responsive">

				<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
					<thead>
					<tr>
						@foreach($paginateConfig as $config)
							<th>
								<span>{{ $config['label'] }}</span>
								@if (! empty($config['sort']))
									<i class="fa fa-fw" aria-hidden="true" title="Copy to use sort"></i>
								@endif
							</th>
						@endforeach
						@if(!empty($actions))
							@if(!empty($actions['label']))
								<th {{$actions['is_separate'] ? 'class=text-center colspan=4' : ''}}>
									{{ $actions['label'] }}
								</th>
							@endif
						@endIf
					</tr>
					</thead>
					<tbody>
					@foreach($items as $item)
						<tr>
							@foreach($paginateConfig as $config)
								<td>
									@if($config['is_html'])
										{!! $item->{$config['attribute']} !!}
									@else
										@if (empty($config['short']))
											{{ $item->{$config['attribute']} }}
										@else
											<span title="{{ $item->{$config['attribute']} }}">
												@php
													if (is_array($config['short'])) {
														$min = array_shift($config['short']);
														$max = array_shift($config['short']);
														$max = $max ?? $min;
														$short = random_int($min, $max);
													} else {
														$short = $config['short'];
													}
												@endphp
									            {{ str_short($item->{$config['attribute']}, $short, 3)}}
											</span>
										@endif
									@endif
								</td>
							@endforeach
							@if(!empty($actions))
								@include('partials.crud.actions')
							@endIf
						</tr>
					@endforeach
					</tbody>
				</table>
			{{$items->appends(app('request')->all())->links()}}
			<!-- /.table-responsive -->
			</div>
		@else
			<p class="text-center border rounded">
				@isset($noItemMessage)
					{!! $noItemMessage !!}
				@else
					@lang('No :resource', ['resource' => humanize($resource)])
				@endif
			</p>
		@endif
	</div>
</div>

