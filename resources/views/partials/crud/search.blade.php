@if ($search->isNotEmpty())
    @php
        $url =\Illuminate\Support\Facades\URL::current();
    @endphp
    <div class="row">
        @if(! request('advanced'))
            <div class="col-lg-10 text-right">
            </div>
            <div class="col-lg-2">

                {!! Form::open(['url' => $url, 'method' => 'get'] )  !!}
                {{ Form::bsText('search', request('search'), ['placeholder' => 'Search by ' . $search->pluck('column')->implode(', ')]) }}
                {{ Form::hidden('advanced', 0) }}
                @if ($searchDetails->isNotEmpty())
                    <a href="{{$url . '?advanced=1'}}">Advanced Search</a>
                @endif
                @if(request('search'))
                    <a href="{{$url}}">Reset</a>
                @endif
                {{ Form::close() }}
            </div>
        @else
            <div class="col-lg-10">
            {!! Form::open(['url' => $url, 'method' => 'get'] )  !!}
            <div class="row">
                @foreach($searchDetails as $details)
                    <div class="col-sm-6">
                        @if($details['formMethod'] == 'bsCheckbox')
                            {{ Form::bsCheckbox($details['column'], 1, request($details['column'])) }}
                        @elseif($details['formMethod'] == 'bsSelect')
                            @php
                                $details['options']['class'] = !empty($details['options']['class']) ? $details['options']['class'] . ' select2' : 'form-control select2';
                                $details['options']['multiple'] = true;
                                $items = ${$details['items']};
                                $items[''] = $items[''] ?? '--Select--';
                            @endphp
                            {{ Form::bsSelect($details['column'] . '[]', $items, request($details['column']), $details['options']) }}
                        @else
                            {{ Form::{$details['formMethod']}($details['column'], request($details['column']), $details['options']) }}
                        @endif
                    </div>
                @endforeach
                {{ Form::hidden('advanced', 1) }}
                <div class="col-sm-12">
                    {{ Form::bsSubmit('Advanced Search', ['class' => 'btn btn-default']) }}
                    <a href="{{$url . '?advanced=0'}}">Simple Search</a>
                </div>
            </div>

            <a href="{{$url .  '?advanced=1'}}">Reset</a>
            {{ Form::close() }}
            </div>
        @endif
    </div>
@endif

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script>

<script>

    $(".select2").select2({
    });
</script>
