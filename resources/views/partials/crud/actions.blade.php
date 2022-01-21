@if(!empty($actions['label']))

    @if(! $actions['is_separate'])
		<td>
	@endif

    @foreach($actions['list'] as $actionData)
        @if( $actions['is_separate'])
            <td>
        @endif
        @php
            $actionData['route'] = $actionData['route'] ?? str_replace('index', $actionData['action'], $currentRouteName);
            if (empty($actionData['params'])) {
                $routeParams = Route::current()->parameters();
                $routeParams[] = $item->getKey();
            } else {
                $routeParams = $actionData['params'];
            }

            $url = route($actionData['route'], $routeParams);
        @endphp

        @if (!empty($actionData['method']))
            {!! Form::open(['url' => $url, 'class' => 'inline-form'] )  !!}
            {{Form::hidden('_method', $actionData['method'])}}

            @isset($actionData['icon'])
                @php
                    $submitButton = '<i class="fa fa-' . $actionData['icon'] . ' fa-fw"></i>';
                    if (isset($actionData['label'])) {
                        $submitButton .= $actionData['label'];
                    }

                    $submitButtonClass = !empty($actionData['submit-class']) ? !empty($actionData['submit-class']) . ' fabutton ' : 'fabutton ';
                @endphp
                {{Form::button($submitButton, ['class' => $submitButtonClass, 'type' => 'submit'])  }}
            @else
                {{Form::submit($actionData['label'], !empty($actionData['submit-class']) ? ['class' => $actionData['submit-class']] : [])  }}
            @endisset
            {{ Form::close() }}
        @elseif ($actionData['action'] != 'destroy')
            <a href="{{$url}}">
                @isset($actionData['icon'])
                    <i class="fa fa-{{$actionData['icon']}} fa-fw"></i>
                @endisset
                @isset($actionData['label'])
                    {{$actionData['label']}}
                @endisset
            </a>
        @elseif(Route::has($actionData['route']))
            {!! Form::open(['url' => $url, 'class' => 'delete_form'] )  !!}
            {{Form::hidden('_method', 'DELETE')}}

            @isset($actionData['icon'])
                <i class="pe-7s-{{$actionData['icon']}}"
                   data-toggle="modal" data-target="#delete_item"
                ></i>
            @endisset
            @isset($actionData['label'])
                {{$actionData['label']}}
            @endisset

            {{ Form::close() }}
        @endif
        @if( $actions['is_separate'])
            </td>
        @endif
    @endforeach

	@if(! $actions['is_separate'])
		</td>
	@endif

@endif

<style>
	.fabutton {
		background: none;
		padding: 0px;
		border: none;
		display: inline-block;
	}
	.inline-form {
		display: inline-block;
	}
</style>
