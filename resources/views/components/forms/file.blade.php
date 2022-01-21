<div class="form-group{{$errors->has($name) ? ' has-error' : ''}}">
    @php
        $model = Form::getModel();
        $url = '';
        $value = '';
        if ($model) {
            $url = $model->getUrlByAttribute($name);
            $value = $model->{$name};
        }
        $src = $options['src'] ?? '';
        unset($options['src']);
    @endphp
    
    <label for="Upload Image"> {{ $options['label'] ?? 'Upload' . humanize(str_replace('_path', '', $name)) }}</label>
    <br>
    {{ Form::file($name . '[file]', array_merge(['class' => ' upload', 'id' => $name, 'onchange' => "readURL(this);"], $options)) }}
    
    <div>
        @if($url)
            <img id="show-img-{{$name}}" class="show-upload" src="{{ $url }}" alt="your image" style="max-width:200px;max-height:200px"/>
            <br>
            {{ Form::text($name . '[name]', $value, ['id' => $name . '_name', 'style' => 'min-width:200px']) }}
        @elseif($src)
            <img id="show-img-{{$name}}" class="show-upload" src="{{ $src }}" alt="your image" style="max-width:200px;max-height:200px"/>
        @else
            <img id="show-img-{{$name}}" class="show-upload" src="#" alt="your image" style="display: none;max-width:200px;max-height:200px">
            <br>
            {{ Form::text($name . '[name]', $value, ['id' => $name . '_name', 'style' => "min-width:200px;display: none"]) }}
        @endif
    </div>

    @if($errors->getBag('default')->has($name))
        @foreach($errors->get($name) as $errorMessage)
            <div style="color: red">
                {{$errorMessage}}
            </div>
        @endforeach
    @endif
</div>
