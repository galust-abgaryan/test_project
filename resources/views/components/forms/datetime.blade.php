<div class="form-group{{$errors->has($name) ? ' has-error' : ''}}">
    {{ Form::label($name, null, ['class' => 'control-label']) }}
    {{ Form::datetime($name, $value, array_merge(['class' => 'form-control'], $options)) }}
    @if($errors->getBag('default')->has($name))
        @foreach($errors->get($name) as $errorMessage)
            <div style="color: red">
                {{$errorMessage}}
            </div>
        @endforeach
    @endif
</div>