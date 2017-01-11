@extends('admin.layouts.base')

@section('page.title')
    Ficha de {{ $animal->name }}
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
        <a href="{{ route('admin::panel::animals::health::edit', ['animal_id' => $animal->id, 'id' => $health->id]) }}">{{ $health->title }}</a>
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
                    <form action="{{ route('admin::panel::animals::health::update', ['animal_id' => $animal->id, 'id' => $health->id]) }}" method="POST" class="form-horizontal form-bordered form-label-stripped">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="alert alert-info text-center">
                            La salud del animal está sincronizada con el calendario. A más información se proporcione sobre la salud, mejor será la integración con el mismo.
                        </div>
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.title')) }}</label>
                            <div class="col-md-10">
                                <input type="text" name="title" value="{{ $health->title }}" class="form-control" required>
                                {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('hidden_in_calendar') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* Mostrar en el calendario</label>
                            <div class="col-md-10">
                                <select name="hidden_in_calendar" class="form-control">
                                    <option value="0">Si</option>
                                    <option value="1" {{ $health->hidden_in_calendar ? 'selected' : '' }}>No</option>
                                </select>
                                {!! $errors->first('hidden_in_calendar', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.type')) }}</label>
                            <div class="col-md-10">
                                <select name="type" class="form-control animal-health-treatment" placeholder="Estado...">
                                    @foreach(config('protecms.animals.health.type') as $type)
                                        <option value="{{ $type }}"  {{ $health->type == $type ? 'selected' : '' }}>{{ trans('animals.health.type.' . $type) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('type', '<span class="help-block">:message</span>') !!}

                                <div id="animal-health-treatment-form" {!! $health->type == 'treatment' ? 'style="display:block"' : 'style="display:none"' !!}>
                                    <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos del tratamiento <small>(ningún campo es obligatorio)</small></h4>
                                    <div class="form-group">
                                        <label for="" class="control-label">Tratamiento de por vida</label>
                                        <select name="treatments_life" class="form-control">
                                            @foreach(config('protecms.animals.health.treatments.life') as $life)
                                                <option value="{{ $life }}" {{ $health->treatments_life == $life ? 'selected' : '' }}>{{ trans('animals.health.treatments.life.' . $life) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label">Número de tratamientos</label>
                                        <input type="number" name="treatments_number" value="{{ $health->treatments_number or '' }}" class="form-control" {{ $health->treatments_life ? 'disabled=disabled' : '' }}>
                                    </div>
                                    <div class="form-group {{ $errors->has('medicine') ? 'has-error' : '' }}">
                                        <label class="control-label">{{ ucfirst(trans('validation.attributes.medicine')) }}</label>
                                        <input type="text" name="medicine" value="{{ $health->medicine }}" class="form-control">
                                        {!! $errors->first('medicine', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label">Tratar cada</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6" style="padding: 0; border: 0">
                                            <input type="number" name="treatments_each" value="{{ $health->treatments_each or '' }}" class="form-control">
                                        </div>
                                        <div class="col-md-6" style="padding: 0; border: 0">
                                            <select name="treatments_time" class="form-control animal-health-treatment" placeholder="Estado...">
                                                @foreach(config('protecms.animals.health.treatments.time') as $time)
                                                    <option value="{{ $time }}" {{ $health->treatments_time == $time ? 'selected' : '' }}>{{ trans('animals.health.treatments.time.' . $time) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="animal-health-test-form" {!! $health->type == 'test' ? 'style="display:block"' : 'style="display:none"' !!}>
                                    <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos de la prueba <small>(ningún campo es obligatorio)</small></h4>
                                    <div class="form-group">
                                        <label for="" class="control-label">Resultado</label>
                                        <select name="test_result" class="form-control animal-health-test">
                                            @foreach(config('protecms.animals.health.test') as $test)
                                                <option value="{{ $test }}" {{ $health->test_result == $test ? 'selected' : '' }}>{{ trans('animals.health.test.' . $test) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.start_date')) }}</label>
                            <div class="col-md-10">
                                <input type="text" name="start_date" value="{{ $health->start_date ? $health->start_date->format('d-m-Y H:i') : '' }}" class="form-control datetimepicker-not-inline" required>
                                {!! $errors->first('start_date', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.end_date')) }}</label>
                            <div class="col-md-10">
                                <input type="text" name="end_date" value="{{ $health->end_date ? $health->end_date->format('d-m-Y H:i') : '' }}" class="form-control datetimepicker-not-inline">
                                {!! $errors->first('end_date', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('cost') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.cost')) }}</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <input type="number" name="cost" value="{{ $health->cost }}" class="form-control">
                                    <span class="input-group-addon" id="basic-addon2">€</span>
                                </div>
                                {!! $errors->first('cost', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.observations')) }}</label>
                            <div class="col-md-10">
                                <textarea name="text" class="form-control tinymce">{{ $health->text }}</textarea>
                                {!! $errors->first('text"', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-4">
                                    <input type="submit" class="btn btn-block btn-primary" value="Actualizar">
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