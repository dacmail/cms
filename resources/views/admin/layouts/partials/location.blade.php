<input type="hidden" name="city_id" value="">
<input type="hidden" name="state_id" value="">
<input type="hidden" name="city_id" value="">
@if(isset($model))
    <div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
        <label for="country_id" class="control-label col-md-2">Pais</label>
        <div class="col-md-10">
            <select name="country_id" id="country_id" class="form-control select-country">
                <option value="" {{ ! $model->country ? 'disabled selected' : '' }}>Seleccione...</option>
                @foreach (App\Models\Location\Country::orderBy('name')->get() as $country)
                    <option value="{{ $country->id }}" {{ $model->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('country_id', '<span class="help-block">:message</span>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('state_id') ? 'has-error' : '' }}">
        <label for="state_id" class="control-label col-md-2">Estado</label>
        <div class="col-md-10">
            <select name="state_id" id="state_id" class="form-control select-state" {{ ! $model->country_id ? 'disabled' : '' }}>
                @if ($model->country_id)
                    <option value="" {{ ! $model->state ? 'selected' : '' }}>Seleccione...</option>
                    @foreach ($model->country->states as $state)
                        <option value="{{ $state->id }}" {{ $model->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                    @endforeach
                @else
                    <option value="" disabled {{ ! $model->state ? 'selected' : '' }}>Seleccione un país...</option>
                @endif
            </select>
            {!! $errors->first('state_id', '<span class="help-block">:message</span>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
        <label for="city_id" class="control-label col-md-2">Ciudad</label>
        <div class="col-md-10">
            <select name="city_id" id="city_id" class="form-control select-city" {{ ! $model->state_id ? 'disabled' : '' }}>
                @if ($model->state_id)
                    <option value="" {{ ! $model->city ? 'selected' : '' }}>Seleccione...</option>
                    @foreach ($model->state->cities as $city)
                        <option value="{{ $city->id }}" {{ $model->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                    @endforeach
                @else
                    <option value="" disabled {{ ! $model->city ? 'selected' : '' }}>Seleccione...</option>
                @endif
            </select>
            {!! $errors->first('city_id', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
@else
    <div class="form-group {{ $errors->has('country_id') ? 'has-error' : '' }}">
        <label for="country_id" class="control-label col-md-2">Pais</label>
        <div class="col-md-10">
            <select name="country_id" id="country_id" class="form-control select-country">
                <option value="" selected>Seleccione...</option>
                @foreach (App\Models\Location\Country::orderBy('name')->get() as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('country_id', '<span class="help-block">:message</span>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('state_id') ? 'has-error' : '' }}">
        <label for="state_id" class="control-label col-md-2">Estado</label>
        <div class="col-md-10">
            <select name="state_id" id="state_id" class="form-control select-state" disabled>
                <option value="" selected>Debes seleccionar un pais...</option>
            </select>
            {!! $errors->first('state_id', '<span class="help-block">:message</span>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('city_id') ? 'has-error' : '' }}">
        <label for="city_id" class="control-label col-md-2">Ciudad</label>
        <div class="col-md-10">
            <select name="city_id" id="city_id" class="form-control select-city" disabled>
                <option value="" selected>Debes seleccionar un estado...</option>
            </select>
            {!! $errors->first('city_id', '<span class="help-block">:message</span>') !!}
        </div>
    </div>
@endif