@extends('admin.layouts.base')

@section('page.title')
    Añadir salud a la ficha de {{ $animal->name }}
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::animals::index') }}">Animales</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::animals::edit', ['id' => $animal->id]) }}">{{ $animal->name }}</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::animals::health::index', ['id' => $animal->id]) }}">Salud</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::animals::health::create', ['animal_id' => $animal->id]) }}">Añadir salud</a>
    </li>
@stop

@section('content')
    <div class="row">
        <div class="col-md-2 animal-menu">
            @include('admin.layouts.partials.animalmenu', [
                'animal' => $animal
            ])
        </div>
        <div class="col-md-10">
            <div class="portlet light bordered form-fit">
                <div class="portlet-body form">
                    <form action="{{ route('admin::panel::animals::health::store', ['animal_id' => $animal->id]) }}" method="POST" class="form-horizontal form-bordered form-label-stripped">
                        {{ csrf_field() }}
                        <div class="alert alert-info text-center">
                            La salud del animal está sincronizada con el calendario. A más información se proporcione sobre la salud, mejor será la integración con el mismo.
                        </div>
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.title')) }}</label>
                            <div class="col-md-10">
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                                {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('hidden_in_calendar') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* Mostrar en el calendario</label>
                            <div class="col-md-10">
                                <select name="hidden_in_calendar" class="form-control">
                                    <option value="0">Si</option>
                                    <option value="1">No</option>
                                </select>
                                {!! $errors->first('hidden_in_calendar', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.type')) }}</label>
                            <div class="col-md-10">
                                <select name="type" class="form-control animal-health-treatment" placeholder="Estado...">
                                    @foreach(config('protecms.animals.health.type') as $type)
                                        <option value="{{ $type }}">{{ trans('animals.health.type.' . $type) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('type', '<span class="help-block">:message</span>') !!}

                                <div id="animal-health-treatment-form">
                                    <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos del tratamiento <small>(ningún campo es obligatorio)</small></h4>
                                    <div class="form-group">
                                        <label for="" class="control-label">Tratamiento de por vida</label>
                                        <select name="treatments_life" class="form-control">
                                            @foreach(config('protecms.animals.health.treatments.life') as $life)
                                                <option value="{{ $life }}">{{ trans('animals.health.treatments.life.' . $life) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label">Número de tratamientos</label>
                                        <input type="number" name="treatments_number" value="{{ old('treatments_number') or '' }}" class="form-control">
                                    </div>
                                    <div class="form-group {{ $errors->has('medicine') ? 'has-error' : '' }}">
                                        <label class="control-label">{{ ucfirst(trans('validation.attributes.medicine')) }}</label>
                                        <input type="text" name="medicine" value="{{ old('medicine') }}" class="form-control">
                                        {!! $errors->first('medicine', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label">Tratar cada</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6" style="padding: 0; border: 0">
                                            <input type="number" name="treatments_each" value="{{ old('treatments_each') or '' }}" class="form-control">
                                        </div>
                                        <div class="col-md-6" style="padding: 0; border: 0">
                                            <select name="treatments_time" class="form-control animal-health-treatment">
                                                @foreach(config('protecms.animals.health.treatments.time') as $time)
                                                    <option value="{{ $time }}">{{ trans('animals.health.treatments.time.' . $time) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="animal-health-test-form" style="display: none">
                                    <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos de la prueba <small>(ningún campo es obligatorio)</small></h4>
                                    <div class="form-group">
                                        <label for="" class="control-label">Resultado</label>
                                        <select name="test_result" class="form-control animal-health-test">
                                            @foreach(config('protecms.animals.health.test') as $test)
                                                <option value="{{ $test }}">{{ trans('animals.health.test.' . $test) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.start_date')) }}</label>
                            <div class="col-md-10">
                                <input type="text" name="start_date" value="{{ old('start_date') }}" class="form-control datetimepicker-not-inline" required>
                                {!! $errors->first('start_date', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.end_date')) }}</label>
                            <div class="col-md-10">
                                <input type="text" name="end_date" value="{{ old('end_date') }}" class="form-control datetimepicker-not-inline">
                                {!! $errors->first('end_date', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('cost') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.cost')) }}</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <input type="number" name="cost" value="{{ old('cost') }}" class="form-control">
                                    <span class="input-group-addon" id="basic-addon2">€</span>
                                </div>
                                {!! $errors->first('cost', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('finances') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* Incluir gasto en las finanzas</label>
                            <div class="col-md-10">
                                <select name="finances" class="form-control">
                                    <option value="0">No</option>
                                    <option value="1">Si</option>
                                </select>
                                {!! $errors->first('finances', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.observations')) }}</label>
                            <div class="col-md-10">
                                <textarea name="text" class="form-control tinymce">{{ old('text') }}</textarea>
                                {!! $errors->first('text"', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-4">
                                    <input type="submit" class="btn btn-block btn-primary" value="Añadir">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>
    $('select[name="treatments_life"]').on('change', function () {
        var treatments_number = $('input[name="treatments_number"]');
        var end_date = $('input[name="end_date"]');
        if ($(this).val() == 1) {
            treatments_number.val('');
            end_date.val('');
            treatments_number.prop('disabled', true);
            end_date.prop('disabled', true);
        } else {
            treatments_number.prop('disabled', false);
            end_date.prop('disabled', false);
        }
    });
</script>
@endpush