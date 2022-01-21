@php
	$options = array_merge($options, ['class' => 'btn btn-primary']);
@endphp

{{ Form::submit($value, $options) }}
