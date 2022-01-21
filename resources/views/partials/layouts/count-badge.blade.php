@isset($config['class'])
	@php
		if (! empty($config['query'])) {
			$count = (new $config['class'])->getQueryByArray($config['query'])->count();
		} else {
			$count = $config['class']::count();
		}

	@endphp

	<span class="badge">{{ $count }}</span>
@endisset