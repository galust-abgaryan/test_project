{{ Form::model($item ?? null, ['route' => $route, 'files' => true, 'method' => isset($item) ? "PUT" : "POST"]) }}

<div class="row">

    <div class="col-sm-6">
        {{ Form::bsSelect('type', App\Constants\ConstMailType::constants(), null, ['placeholder' => '--Select--', 'readonly' => true]) }}
    </div>

    <div class="col-sm-6">
        {{ Form::bsText('label') }}
    </div>

    <div class="col-sm-6">
        {{ Form::bsText('subject') }}
    </div>

    <div class="col-sm-12">
        {{ Form::bsTextarea('body', null, ['class' => 'form-control tinymce']) }}
    </div>

    @isset($item)
        <div class="col-sm-12">
            <h5>Available tags</h5>
            <div class="row">
                @foreach(\App\Constants\ConstMailTypeTags::getTags($item->type) as $tag => $_)
                    <div class="col-sm-2">
                        {{$tag }}
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="col-sm-12">
        {{ Form::bsSubmit($title, ['class' => 'btn btn-default']) }}
    </div>

</div>

{{ Form::close() }}

@include('partials.tinymce')
