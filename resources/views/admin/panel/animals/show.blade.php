@extends('admin.layouts.base')

@section('page.title')
    {{ $animal->name }}
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::animals::index') }}">Animales</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::animals::show', ['id' => $animal->id]) }}">{{ $animal->name }}</a>
    </li>
@stop

@section('content')
<div class="alert alert-info text-center col-md-12">
    Esta página está en construcción. Falta añadir accesos a la salud del animal, fotos, apadrinamientos, etc...
</div>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered form-fit">
            <div class="portlet-body form">
                <form class="form-horizontal form-bordered form-label-stripped">
                    <input type="hidden" name="langform" value="{{ $langform }}">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.name')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $animal->name }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('old_name') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.old_name')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $animal->old_name or '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('identifier') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.identifier')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $animal->identifier or '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('microchip') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.microchip')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $animal->microchip or '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('litter') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.litter')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $animal->litter or '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('visible') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.visible')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ trans('animals.visible.' . $animal->visible) }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.status')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ trans_choice('animals.status.' . $animal->status, 1) }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('kind') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.kind')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ trans_choice('animals.kind.' . $animal->kind, 1) }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.gender')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ trans_choice('animals.gender.' . $animal->gender, 1) }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.location')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ trans('animals.location.' . $animal->location) }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('birth_date') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.birth_date')) }}</label>
                        <div class="col-md-10">
                            <p><label><input type="checkbox" name="birth_date_approximate" {{ $animal->birth_date_approximate ? 'checked' : '' }} value="1" disabled> &nbsp;&nbsp;Fecha aproximada</label></p>
                            <p class="form-control-static">{{ $animal->birth_date ? $animal->birth_date->format('d-m-Y') : '-' }}</p>
                            {!! $errors->first('birth_date', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('entry_date') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.entry_date')) }}</label>
                        <div class="col-md-10">
                            <p><label><input type="checkbox" name="entry_date_approximate" {{ $animal->entry_date_approximate ? 'checked' : '' }} value="1" disabled> &nbsp;&nbsp;Fecha aproximada</label></p>
                            <p class="form-control-static">{{ $animal->entry_date ? $animal->entry_date->format('d-m-Y') : '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has($langform . 'breed') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.breed')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $animal->hasTranslation($langform) ? $animal->translate($langform)->breed : '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.weight')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $animal->weight or '-' }}kg</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('height') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.height')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $animal->height or '-' }}cm</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('length') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.length')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $animal->length or '-' }}cm</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has($langform . 'health_text') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.health_text')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $animal->hasTranslation($langform) ? $animal->translate($langform)->health_text : '' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has($langform . 'private_text') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.private_text')) }}<br><small>(Información sobre el animal sólo disponible para voluntarios)</small></label>
                        <div class="col-md-10">

                            @include('admin.layouts.partials.maintranslationtext', [
                                'model' => $animal,
                                'field' => 'private_text'
                            ])

                            <p class="form-control-static">{{ $animal->hasTranslation($langform) ? $animal->translate($langform)->private_text : '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has($langform . 'text') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.description')) }}</label>
                        <div class="col-md-10">

                            @include('admin.layouts.partials.maintranslationtext', [
                                'model' => $animal,
                                'field' => 'text'
                            ])

                            <p class="form-control-static">{{ $animal->hasTranslation($langform) ? $animal->translate($langform)->text : '-' }}</p>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-4">
                                <a href="{{ route('admin::panel::animals::index') }}" class="btn btn-block btn-primary">Volver al listado</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('page.help.text')
    <p>En esta página se puede ver la ficha del animal.</p>
    <p>Actualmente se encuentra en construcción.</p>
@stop