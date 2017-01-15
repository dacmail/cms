@extends('admin.layouts.base')

@section('page.title')
    Editando la ficha de {{ $animal->name }}<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::animals::index') }}">Animales</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::animals::edit', ['id' => $animal->id]) }}">{{ $animal->name }}</a>
    </li>
@stop

@section('content')
<div class="row">

    @include('admin.layouts.partials.selectlang', [
        'model' => $animal,
        'route' => route('admin::panel::animals::delete_translation', ['id' => $animal->id])
    ])

    <div class="col-md-2 animal-menu">
        @include('admin.layouts.partials.animalmenu', [
            'animal' => $animal
        ])
    </div>
    <div class="col-md-10">
        <div class="portlet light bordered form-fit">
            <div class="portlet-body form">
                <form action="{{ route('admin::panel::animals::update', ['id' => $animal->id]) }}" method="POST" class="form-horizontal form-bordered form-label-stripped">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input type="hidden" name="langform" value="{{ $langform }}">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.name')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="name" value="{{ $animal->name }}" class="form-control" required>
                            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('old_name') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.old_name')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="old_name" value="{{ $animal->old_name }}" class="form-control">
                            {!! $errors->first('old_name', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('identifier') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.identifier')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="identifier" value="{{ $animal->identifier }}" class="form-control">
                            {!! $errors->first('identifier', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('microchip') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.microchip')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="microchip" value="{{ $animal->microchip }}" class="form-control">
                            {!! $errors->first('microchip', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('litter') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.litter')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="litter" value="{{ $animal->litter }}" class="form-control">
                            {!! $errors->first('litter', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('visible') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.visible')) }}</label>
                        <div class="col-md-10">
                            <select name="visible" class="form-control" placeholder="Estado...">
                                @foreach(config('protecms.animals.visible') as $visible)
                                    <option value="{{ $visible }}" {{ $animal->visible == $visible ? 'selected' : '' }}>{{ trans('animals.visible.' . $visible) }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.status')) }}</label>
                        <div class="col-md-10">
                            <select name="status" class="form-control animal-status" placeholder="Estado...">
                                @foreach(config('protecms.animals.status') as $status)
                                    <option value="{{ $status }}" {{ $animal->status == $status ? 'selected' : '' }}>{{ trans_choice('animals.status.' . $status, 1) }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('status', '<span class="help-block">:message</span>') !!}

                            <div id="adopter-form" {!! $animal->status == 'adopted' ? 'style="display:block"' : '' !!}>
                                <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos del adoptante <small>(ningún campo es obligatorio)</small></h4>
                                <div class="form-group">
                                    <label for="" class="control-label">Nombre</label>
                                    <input type="text" name="meta[adopter][name]" value="{{ $animal->meta['adopter']['name'] or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Correo electrónico</label>
                                    <input type="email" name="meta[adopter][email]" value="{{ $animal->meta['adopter']['email'] or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Teléfono</label>
                                    <input type="text" name="meta[adopter][phone]" value="{{ $animal->meta['adopter']['phone'] or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Fecha de la adopción</label>
                                    <input type="text" name="meta[adopter][date]" value="{{ $animal->meta['adopter']['date'] or '' }}" class="form-control datetime-not-inline" value="">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Observaciones</label>
                                    <textarea name="meta[adopter][text]" class="form-control" rows="5">{{ $animal->meta['adopter']['text'] or '' }}</textarea>
                                </div>
                            </div>
                            <div id="reservation-form" {!! $animal->status == 'reserved' ? 'style="display:block"' : '' !!}>
                                <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos del reservante <small>(ningún campo es obligatorio)</small></h4>
                                <div class="form-group">
                                    <label for="" class="control-label">Nombre</label>
                                    <input type="text" name="meta[reservation][name]" value="{{ $animal->meta['reservation']['name'] or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Correo electrónico</label>
                                    <input type="email" name="meta[reservation][email]" value="{{ $animal->meta['reservation']['email'] or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Teléfono</label>
                                    <input type="text" name="meta[reservation][phone]" value="{{ $animal->meta['reservation']['phone'] or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Fecha de la reserva</label>
                                    <input type="text" name="meta[reservation][date]" value="{{ $animal->meta['reservation']['date'] or '' }}" class="form-control datetime-not-inline" value="">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Observaciones</label>
                                    <textarea name="meta[reservation][text]" class="form-control" rows="5">{{ $animal->meta['reservation']['text'] or '' }}</textarea>
                                </div>
                            </div>
                            <div id="found-form" {!! $animal->status == 'found' ? 'style="display:block"' : '' !!}>
                                <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos <small>(ningún campo es obligatorio)</small></h4>
                                <div class="form-group">
                                    <label for="" class="control-label">Observaciones</label>
                                    <textarea name="meta[found][text]" class="form-control" rows="5">{{ $animal->meta['found']['text'] or '' }}</textarea>
                                </div>
                            </div>
                            <div id="lost-form" {!! $animal->status == 'lost' ? 'style="display:block"' : '' !!}>
                                <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos <small>(ningún campo es obligatorio)</small></h4>
                                <div class="form-group">
                                    <label for="" class="control-label">Observaciones</label>
                                    <textarea name="meta[lost][text]" class="form-control" rows="5">{{ $animal->meta['lost']['text'] or '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('kind') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.kind')) }}</label>
                        <div class="col-md-10">
                            <select name="kind" class="form-control">
                                @foreach(config('protecms.animals.kind') as $kind)

                                    @if (! Auth::user()->hasPermissions(['admin.panel.animals.' . $kind]))
                                        @continue
                                    @endif

                                    <option value="{{ $kind }}" {{ $animal->kind == $kind ? 'selected' : '' }}>{{ trans_choice('animals.kind.' . $kind, 1) }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('kind', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.gender')) }}</label>
                        <div class="col-md-10">
                            <select name="gender" class="form-control">
                                @foreach(config('protecms.animals.gender') as $gender)
                                    <option value="{{ $gender }}" {{ $animal->gender == $gender ? 'selected' : '' }}>{{ trans_choice('animals.gender.' . $gender, 1) }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.location')) }}</label>
                        <div class="col-md-10">
                            <select name="location" class="form-control animal-location">
                                @foreach(config('protecms.animals.location') as $location)
                                    <option value="{{ $location }}" {{ $animal->location == $location ? 'selected' : '' }}>{{ trans('animals.location.' . $location) }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('location', '<span class="help-block">:message</span>') !!}

                            <div id="temporary-shelter-form" {!! $animal->location == 'temporary_home' ? 'style="display:block"' : '' !!}>
                                <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos de la acogida <small>(ningún campo es obligatorio)</small></h4>
                                <div class="form-group">
                                    <label for="" class="control-label">Casa de acogida</label>
                                    <select name="temporary_home_id" class="form-control">
                                        <option value="">-</option>
                                        @foreach (App\Models\Animals\TemporaryHome::get() as $temporary_home)
                                            <option value="{{ $temporary_home->id }}" {{ $temporary_home->id === $animal->temporary_home_id ? 'selected' : '' }}>{{ $temporary_home->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">
                                        Puedes <a href="{{ route('admin::panel::temporaryhomes::create') }}">crear una casa de acogida</a> y luego seleccionarla aquí.
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Fecha inicial de la acogida</label>
                                    <input type="text" name="meta[temporary_home][start_date]" value="{{ $animal->meta['temporary_home']['start_date'] or '' }}" class="form-control datetime-not-inline" value="">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Fecha final la acogida</label>
                                    <input type="text" name="meta[temporary_home][end_date]" value="{{ $animal->meta['temporary_home']['end_date'] or '' }}" class="form-control datetime-not-inline" value="">
                                </div>
                            </div>
                            <div id="animal-home-form" {!! $animal->location == 'animal_home' ? 'style="display:block"' : '' !!}>
                                <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos de la residencia <small>(ningún campo es obligatorio)</small></h4>
                                <div class="form-group">
                                    <label for="" class="control-label">Nombre de la residencia</label>
                                    <input type="text" name="meta[animal_home][name]" value="{{ $animal->meta['animal_home']['name'] or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Nombre de la persona de contacto</label>
                                    <input type="text" name="meta[animal_home][name]" value="{{ $animal->meta['animal_home']['name'] or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Correo electrónico</label>
                                    <input type="email" name="meta[animal_home][email]" value="{{ $animal->meta['animal_home']['email'] or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Teléfono</label>
                                    <input type="text" name="meta[animal_home][phone]" value="{{ $animal->meta['animal_home']['phone'] or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Dirección</label>
                                    <input type="text" name="meta[animal_home][address]" value="{{ $animal->meta['animal_home']['address'] or '' }}" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Fecha de la entrada</label>
                                    <input type="text" name="meta[animal_home][date]" value="{{ $animal->meta['animal_home']['date'] or '' }}" class="form-control datetime-not-inline" value="">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Observaciones</label>
                                    <textarea name="meta[temporary_home][text]" class="form-control" rows="5">{{ $animal->meta['temporary_home']['text'] or '' }}</textarea>
                                </div>
                            </div>
                            <div id="street-form" {!! $animal->location == 'street' ? 'style="display:block"' : '' !!}>
                                <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos <small>(ningún campo es obligatorio)</small></h4>
                                <div class="form-group">
                                    <label for="" class="control-label">Observaciones</label>
                                    <textarea name="meta[street][text]" class="form-control" rows="5">{{ $animal->meta['street']['text'] or '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('birth_date') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.birth_date')) }}</label>
                        <div class="col-md-10">
                            <input type="hidden" name="birth_date_approximate" value="0">
                            <p><label><input type="checkbox" name="birth_date_approximate" {{ $animal->birth_date_approximate ? 'checked' : '' }} value="1"> &nbsp;&nbsp;Fecha aproximada</label></p>
                            <input type="text" name="birth_date" value="{{ $animal->birth_date->format('d-m-Y') }}" class="form-control datetime" required>
                            {!! $errors->first('birth_date', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('entry_date') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.entry_date')) }}</label>
                        <div class="col-md-10">
                            <input type="hidden" name="entry_date_approximate" value="0">
                            <p><label><input type="checkbox" name="entry_date_approximate" {{ $animal->entry_date_approximate ? 'checked' : '' }} value="1"> &nbsp;&nbsp;Fecha aproximada</label></p>
                            <input type="text" name="entry_date" value="{{ $animal->entry_date ? $animal->entry_date->format('d-m-Y') : null }}" class="form-control datetime-not-inline">
                            {!! $errors->first('entry_date', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has($langform . 'breed') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.breed')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="{{ $langform }}[breed]" value="{{ $animal->hasTranslation($langform) ? $animal->translate($langform)->breed : '' }}" class="form-control" placeholder="{{ $animal->hasTranslation(config('app.locale')) ? $animal->translate(config('app.locale'))->breed : '' }}">
                            {!! $errors->first($langform .'.breed"', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.weight')) }}</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="number" name="weight" value="{{ $animal->weight }}" step="0.01" class="form-control" placeholder="{{ $animal->weight }}">
                                <span class="input-group-addon">kg</span>
                            </div>
                            <span class="help-block">Se puede usar coma (,)</span>
                            {!! $errors->first('weight', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('height') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.height')) }}</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="number" name="height" value="{{ $animal->height }}" class="form-control" placeholder="{{ $animal->height }}">
                                <span class="input-group-addon">cm</span>
                            </div>
                            {!! $errors->first('height', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('length') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.length')) }}</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="number" name="length" value="{{ $animal->length }}" class="form-control" placeholder="{{ $animal->length }}">
                                <span class="input-group-addon">cm</span>
                            </div>
                            {!! $errors->first('length', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has($langform . 'health_text') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.health_text')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="{{ $langform }}[health_text]" value="{{ $animal->hasTranslation($langform) ? $animal->translate($langform)->health_text : '' }}" class="form-control" placeholder="{{ $animal->hasTranslation(config('app.locale')) ? $animal->translate(config('app.locale'))->health_text : '' }}">
                            {!! $errors->first($langform .'.health_text"', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has($langform . 'private_text') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.private_text')) }}<br><small>(Información sobre el animal sólo disponible para voluntarios)</small></label>
                        <div class="col-md-10">

                            @include('admin.layouts.partials.maintranslationtext', [
                                'model' => $animal,
                                'field' => 'private_text'
                            ])

                            <textarea name="{{ $langform }}[private_text]" class="form-control tinymce">{{ $animal->hasTranslation($langform) ? $animal->translate($langform)->private_text : '' }}</textarea>
                            {!! $errors->first($langform .'.private_text"', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has($langform . 'text') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.description')) }}</label>
                        <div class="col-md-10">

                            @include('admin.layouts.partials.maintranslationtext', [
                                'model' => $animal,
                                'field' => 'text'
                            ])

                            <textarea name="{{ $langform }}[text]" class="form-control tinymce">{{ $animal->hasTranslation($langform) ? $animal->translate($langform)->text : '' }}</textarea>
                            {!! $errors->first($langform .'.text"', '<span class="help-block">:message</span>') !!}
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

@section('page.help.text')
    <p>En esta página se puede editar la ficha de un animal y acceder a sus fotos, salud, apadrinamientos o exportar su ficha.</p>
    <p>También se añadir traducciones a historia haciendo clic en el desplegable llamado "Cambiar traducción".</p>
    <p>Si habilita las casillas "Fecha aproximada" lo que hace es aproximarse a la fecha. Por ejemplo, si un animal tiene 5 meses y 20 días, solo aparecerá 5 meses. Otro ejemplo, si un animal tiene 1 año y 5 meses, solo aparecerá 1 año.</p>

    <h4>Campos del formulario</h4>
    <p><strong>Identificador:</strong><br> Identificador interno que usan algunas protectoras para identificar a sus animales.</p>
    <p><strong>Camada:</strong><br> Identificador de la camada.</p>
    <p><strong>Visible en la web:</strong><br> Indica si el animal puede ser visible en la web, ya sea en los listados o su ficha.</p>
    <p><strong>Salud:</strong><br> Breve resumen de la salud del animal.</p>
    <p><strong>Texto privado:</strong><br> Este campo puede ser útil para dejar notas del animal internamente. Este campo no es público.</p>
@stop