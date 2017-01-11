<div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
	<label for="country_id" class="control-label">Pais</label>
	<select name="country_id" id="country_id" class="form-control select-country">
		<option value="" disabled selected>Seleccione...</option>
		@foreach (App\Models\Location\Country::orderBy('name')->get() as $country)
			<option value="{{ $country->id }}">{{ $country->name }}</option>
		@endforeach
	</select>
	{!! $errors->first('country_id', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('state_id') ? 'has-error' : '' }}">
	<label for="state_id" class="control-label">Estado</label>
	<select name="state_id" id="state_id" class="form-control select-state" disabled>
		<option value="" disabled selected>Debes seleccionar un pais...</option>
	</select>
	{!! $errors->first('state_id', '<span class="help-block">:message</span>') !!}
</div>

<div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
	<label for="city_id" class="control-label">Ciudad</label>
	<select name="city_id" id="city_id" class="form-control select-city" disabled>
		<option value="" disabled selected>Debes seleccionar un estado...</option>
	</select>
	{!! $errors->first('city_id', '<span class="help-block">:message</span>') !!}
</div>

@push('scripts')
<script>
	
	$('.select-country').on('change', function() {

		var country = $('.select-country option:selected').val();

		$('.select-city').find('option').remove();
		$('.select-city').prop('disabled', true);
		$('.select-city').append($('<option>', {
			value: '',
			text: 'Debes seleccionar un estado',
			disabled: true,
			selected: true
		}));

		$.ajax({
			url: '/api/location/countries/' + country + '/states'
		}).done(function(data) {
			$('.select-state').find('option').remove();
			$('.select-state').prop('disabled', false);

			$('.select-state').append($('<option>', {
				value: '',
				text: 'Seleccione un estado',
				disabled: true,
				selected: true
			}));
			$.each(data, function (i, state) {
				$('.select-state').append($('<option>', {
					value: state.id,
					text: state.name
				}));
			});
		});

	});

	$('.select-state').on('change', function() {

		var state = $('.select-state option:selected').val();

		$.ajax({
			url: '/api/location/states/' + state + '/cities'
		}).done(function(data) {
			$('.select-city').find('option').remove();
			$('.select-city').prop('disabled', false);

			$('.select-city').append($('<option>', {
				value: '',
				text: 'Seleccione una ciudad',
				disabled: true,
				selected: true
			}));
			$.each(data, function (i, state) {
				$('.select-city').append($('<option>', {
					value: state.id,
					text: state.name
				}));
			});
		});

	});

</script>
@endpush