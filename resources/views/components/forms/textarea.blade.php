<div class="form-group{{$errors->has($name) ? ' has-error' : ''}}">
    {{ Form::label($name, null, ['class' => 'control-label']) }}
    {{ Form::textarea($name, $value, array_merge(['class' => 'form-control', 'rows' => 3], $attributes)) }}
    @if($errors->getBag('default')->has($name))
        @foreach($errors->get($name) as $errorMessage)
            <div style="color: red">
                {{$errorMessage}}
            </div>
        @endforeach
    @endif
</div>