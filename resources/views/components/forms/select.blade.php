
@php
    $label = $selectAttributes['label'] ?? $name;
    $errorName = \Illuminate\Support\Str::before($name, '[');
    $model = Form::getModel();
    if (empty($selected)) {
        $selected = $model->{$name} ?? $selected;
    }
@endphp
<div class="form-group{{$errors->has($errorName) ? ' has-error' : ''}}">
    {{ Form::label($label, null, ['class' => 'control-label']) }}

    {{ Form::select($name, $list, $selected, array_merge(['class' => 'form-control'], $selectAttributes), $optionsAttributes, $optgroupsAttributes) }}

    @if($errors->getBag('default')->has($errorName))
        @foreach($errors->get($errorName) as $errorMessage)
            <div style="color: red">
                {{$errorMessage}}
            </div>
        @endforeach
    @endif
</div>
