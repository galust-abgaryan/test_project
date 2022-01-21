<div class="form-group{{$errors->has($name) ? ' has-error' : ''}}">
    {{ Form::label($name, null, ['class' => 'control-label']) }}
    @php
        $model = Form::getModel();
        if ($model) {
            $value = \Carbon\Carbon::parse($model->{$name});
        }
    @endphp
    {{ Form::date($name, $value, array_merge(['class' => 'form-control'], $attributes)) }}
    @if($errors->getBag('default')->has($name))
        @foreach($errors->get($name) as $errorMessage)
            <div style="color: red">
                {{$errorMessage}}
            </div>
        @endforeach
    @endif
</div>