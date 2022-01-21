<div class="scrollbar-sidebar">
	<div class="app-sidebar__inner">
		<ul class="vertical-nav-menu">
			@foreach(config('codearea-view.sidebar') as $sidebars)
				@isset($sidebars['header'])
					<li class="app-sidebar__heading">{{ $sidebars['header'] }}</li>
				@endisset
				@foreach($sidebars['sidebars'] as $sidebar)
					@isset($sidebar['list'])
						<li>
							<a
									href="#"
									@if(collect($sidebar['list'])->contains('route', Route::currentRouteName() )) class="mm-active"@endif
							>
								<i class="metismenu-icon pe-7s-{{ $sidebar['icon'] }}"></i>
								{{ $sidebar['label'] }}
								@php
									$subLabel = '';
									foreach ($sidebar['list'] as $list) {
										if(isset($list['route']) ? Route::currentRouteName() == $list['route'] : $list['url'] == URL::current()) {
											$subLabel = '> ' . \Illuminate\Support\Str::limit($list['label'], 10);
										}
									}
								@endphp
								{{ $subLabel }}
								
								<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
							</a>
							<ul>
								@foreach($sidebar['list'] as $list)
									<li >
										<a
												href="{{ isset($list['route']) ? route($list['route']) : url($list['url']) }}"
												@if(isset($list['route']) ? Route::currentRouteName() == $list['route'] : $list['url'] == URL::current()) class="mm-active"@endif
										>
											<i class="metismenu-icon"></i>
											{{ $list['label'] }}
										</a>
									</li>
								@endforeach
							</ul>
						</li>
					@else
						<li>
							<a
									href="{{ isset($sidebar['route']) ? route($sidebar['route']) : url($sidebar['url'])}}"
									@if(isset($sidebar['route']) ? Route::currentRouteName() == $sidebar['route'] : $sidebar['url'] == URL::current()) class="mm-active"@endif
							>
								<i class="metismenu-icon pe-7s-{{ $sidebar['icon'] }}"></i>
								{{ $sidebar['label'] }}
							</a>
						</li>
					@endisset
				@endforeach
			@endforeach
		</ul>
	</div>
</div>