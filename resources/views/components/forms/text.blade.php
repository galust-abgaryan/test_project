<div class="position-relative form-group {{$errors->has($name) ? ' has-error' : ''}}">
	@php
		$label = $attributes['label'] ?? humanize($name);
	@endphp

    {{ Form::label($label, $label, ['class' => 'control-label']) }}

	@php
		if (Form::getModel()) {
			$value = Form::getModel()->{$name};
		}
	@endphp

    {{ Form::text($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    @if($errors->getBag('default')->has($name))
        @foreach($errors->get($name) as $errorMessage)
            <div style="color: red">
                {{$errorMessage}}
            </div>
        @endforeach
    @endif
</div>