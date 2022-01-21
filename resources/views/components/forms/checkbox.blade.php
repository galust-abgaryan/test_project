<div class="form-group{{$errors->has($name) ? ' has-error' : ''}}">
    <div class="checkbox" style="margin-top: 30px">
        <label>
            {{ Form::hidden($name, 0) }}
            @php
                $checked = Form::getModel() ? Form::getModel()->{$name} : $checked;
                if (isset($options['label'] )) {
                    $label = $options['label'];
                } else {
                    $label = \Illuminate\Support\Str::startsWith($name, 'is') ? humanize($name) : __('Is :name', ['name' => humanize($name)]);
                }
            @endphp
            {{ Form::checkbox($name, 1, $checked, $options) }}
            {{ $label }}
        </label>
    </div>
    @if($errors->getBag('default')->has($name))
        @foreach($errors->get($name) as $errorMessage)
            <div style="color: red">
                {{$errorMessage}}
            </div>
        @endforeach
    @endif
</div>