<div class="row">
	<div class="col-lg-12">
		{{ Form::model($item ?? null, ['route' => $route, 'method' => isset($item) ? "PUT" : "POST"]) }}

		<div class="row">
			<div class="col-sm-6">
				{{ Form::bsText('name') }}
			</div>
			<div class="col-sm-6">
				{{ Form::bsText('surname') }}
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				{{ Form::bsText('south_african_id_number') }}
			</div>
			<div class="col-sm-6">
                {{ Form::bsText('mobile_number') }}
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				{{ Form::bsText('email') }}
			</div>
            @empty($item)
                <div class="col-sm-6">
                    {{ Form::bsText('password') }}
                </div>
            @endempty
            <div class="col-sm-{{empty($item) ? '6' : '3'}}">
                {{ Form::bsDate('birth_date') }}
            </div>
            <div class="col-sm-{{empty($item) ? '6' : '3'}}">
				{{ Form::bsSelect('language', $languages) }}
            </div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				{{ Form::bsSelect('with[interests][]', $interests, null, ['multiple' => 'multiple', 'class' => 'form-control seo-routes can-add-item', 'label' => 'Interests']) }}
			</div>
		</div>


		{{ Form::bsSubmit($title, ['class' => 'btn btn-default' ]) }}

		{{ Form::close() }}
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js"></script>
<script type="text/javascript">
    $(".can-add-item").select2({
        tags: true,
    });
</script>

