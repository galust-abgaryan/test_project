<hr>
<script src="{{asset('js/libs/tinymce/tinymce.min.js')}}"></script>
@php
    $route = Route::currentRouteName();
    $routeParams = Route::current()->parameters;
@endphp

<a class="btn btn-primary" href="{{route($route, array_merge($routeParams, ['skip_editor' => true] ))}}">Skip editor</a>
<a class="btn btn-primary" href="{{route($route, array_merge($routeParams))}}">Use Bootstrtap</a>

@if (empty(request('skip_editor')))
    <script type="text/javascript">
        tinymce.init({
            selector: '.tinymce',
            theme: 'silver',
            plugins: [
                'advlist autolink link lists charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
                'save table contextmenu directionality emoticons template paste textcolor',
                'image',
            ],
            'apiKey' : '{{ config('api.n1ed_key') }}',
            relative_urls : true,
            remove_script_host : false,
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | print preview fullpage | forecolor backcolor emoticons | image',
            image_advtab: true,
            image_title: true,
            textcolor_cols: 4,
            textcolor_map: [
                "1E824C", "text-primary",
                "69A483", "text-secondary",
                "66CC99", "text-green-light",
                "4267b2", "text-facebook",
                "E9E9E9", "text-grey",
                "F8F8F8", "text-grey-light",
                "F5D76E", "text-yellow",
                "656565", "text-black-light",
                "ffffff", "text-white",
                "F95F62", "text-live-score"
            ]
        });
    </script>
@endif
