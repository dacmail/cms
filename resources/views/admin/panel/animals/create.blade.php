@extends('admin.layouts.base')

@section('page.title')
    Nueva ficha<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::animals::index') }}">Animales</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::animals::create') }}">Nueva ficha</a>
    </li>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered form-fit">
            <div class="portlet-body form">
                <form action="{{ route('admin::panel::animals::store') }}" method="POST" class="form-horizontal form-bordered form-label-stripped">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.name')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="name" value="" class="form-control" required>
                            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('identifier') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.identifier')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="identifier" value="" class="form-control">
                            {!! $errors->first('identifier', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('microchip') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.microchip')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="microchip" value="" class="form-control">
                            {!! $errors->first('microchip', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('litter') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.litter')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="litter" value="" class="form-control">
                            {!! $errors->first('litter', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('visible') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.visible')) }}</label>
                        <div class="col-md-10">
                            <select name="visible" class="form-control">
                                @foreach(config('protecms.animals.visible') as $visible)
                                    <option value="{{ $visible }}">{{ trans('animals.visible.' . $visible) }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.status')) }}</label>
                        <div class="col-md-10">
                            <select name="status" class="form-control animal-status">
                                @foreach(config('protecms.animals.status') as $status)
                                    <option value="{{ $status }}">{{ trans_choice('animals.status.' . $status, 1) }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('status', '<span class="help-block">:message</span>') !!}

                            <div id="adopter-form" {!! old('status') == 'adopted' ? 'style="display:block"' : '' !!}>
                                <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos del adoptante <small>(ningún campo es obligatorio)</small></h4>
                                <div class="form-group">
                                    <label for="" class="control-label">Nombre</label>
                                    <input type="text" name="meta[adopter][name]" value="{{ old('meta[adopter][name]') or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Correo electrónico</label>
                                    <input type="email" name="meta[adopter][email]" value="{{ old('meta[adopter][email]') or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Teléfono</label>
                                    <input type="text" name="meta[adopter][phone]" value="{{ old('meta[adopter][phone]') or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Fecha de la adopción</label>
                                    <input type="text" name="meta[adopter][date]" value="{{ old('meta[adopter][date]') or '' }}" class="form-control datetime-not-inline" value="">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Observaciones</label>
                                    <textarea name="meta[adopter][text]" class="form-control" rows="5">{{ old('meta[adopter][text]') or '' }}</textarea>
                                </div> 
                            </div>
                            <div id="reservation-form" {!! old('status') == 'reserved' ? 'style="display:block"' : '' !!}>
                                <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos del reservante <small>(ningún campo es obligatorio)</small></h4>
                                <div class="form-group">
                                    <label for="" class="control-label">Nombre</label>
                                    <input type="text" name="meta[reservation][name]" value="{{ old('meta[reservation][name]') or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Correo electrónico</label>
                                    <input type="email" name="meta[reservation][email]" value="{{ old('meta[reservation][email]') or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Teléfono</label>
                                    <input type="text" name="meta[reservation][phone]" value="{{ old('meta[reservation][phone]') or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Fecha de la reserva</label>
                                    <input type="text" name="meta[reservation][date]" value="{{ old('meta[reservation][date]') or '' }}" class="form-control datetime-not-inline">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Observaciones</label>
                                    <textarea name="meta[reservation][text]" class="form-control" rows="5">{{ old('meta[reservation][text]') or '' }}</textarea>
                                </div>
                            </div>
                            <div id="found-form" {!! old('status') == 'found' ? 'style="display:block"' : '' !!}>
                                <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos <small>(ningún campo es obligatorio)</small></h4>
                                <div class="form-group">
                                    <label for="" class="control-label">Observaciones</label>
                                    <textarea name="meta[found][text]" class="form-control" rows="5">{{ old('meta[found][text]') or '' }}</textarea>
                                </div>
                            </div>
                            <div id="lost-form" {!! old('status') == 'lost' ? 'style="display:block"' : '' !!}>
                                <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos <small>(ningún campo es obligatorio)</small></h4>
                                <div class="form-group">
                                    <label for="meta[lost][text]" class="control-label">Observaciones</label>
                                    <textarea name="meta[lost][text]" id="meta[lost][text]" class="form-control" rows="5">{{ old('meta[lost][text]') or '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('kind') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.kind')) }}</label>
                        <div class="col-md-10">
                            <select name="kind" class="form-control">
                                @foreach(config('protecms.animals.kind') as $kind)

                                    @if (! Auth::user()->hasPermissions(['admin.panel.animals.' . $kind]))
                                        @continue
                                    @endif

                                    <option value="{{ $kind }}">{{ trans_choice('animals.kind.' . $kind, 1) }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('kind', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.gender')) }}</label>
                        <div class="col-md-10">
                            <select name="gender" class="form-control">
                                @foreach(config('protecms.animals.gender') as $gender)
                                    <option value="{{ $gender }}">{{ trans_choice('animals.gender.' . $gender, 1) }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.location')) }}</label>
                        <div class="col-md-10">
                            <select name="location" class="form-control animal-location">
                                @foreach(config('protecms.animals.location') as $location)
                                    <option value="{{ $location }}">{{ trans('animals.location.' . $location) }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('location', '<span class="help-block">:message</span>') !!}

                            <div id="temporary-shelter-form" {!! old('location') == 'temporary_home' ? 'style="display:block"' : '' !!}>
                                <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos de la acogida <small>(ningún campo es obligatorio)</small></h4>
                                <div class="form-group">
                                    <label for="" class="control-label">Casa de acogida</label>
                                    <select name="temporary_home_id" class="form-control">
                                        <option value="">-</option>
                                        @foreach (App\Models\Animals\TemporaryHome::get() as $temporary_home)
                                            <option value="{{ $temporary_home->id }}" {{ $temporary_home->id === old('temporary_home_id') ? 'selected' : '' }}>{{ $temporary_home->name }}</option>
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
                            <div id="animal-home-form" {!! old('location') == 'animal_home' ? 'style="display:block"' : '' !!}>
                                <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos de la residencia <small>(ningún campo es obligatorio)</small></h4>
                                <div class="form-group">
                                    <label for="" class="control-label">Nombre de la residencia</label>
                                    <input type="text" name="meta[animal_home][name]" value="{{ old('[animal_home][name]') or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Nombre de la persona de contacto</label>
                                    <input type="text" name="meta[animal_home][name]" value="{{ old('[animal_home][name]') or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Correo electrónico</label>
                                    <input type="email" name="meta[animal_home][email]" value="{{ old('[animal_home][email]') or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Teléfono</label>
                                    <input type="text" name="meta[animal_home][phone]" value="{{ old('[animal_home][phone]') or '' }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Dirección</label>
                                    <input type="text" name="meta[animal_home][address]" value="{{ old('[animal_home][address]') or '' }}" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Fecha de la entrada</label>
                                    <input type="text" name="meta[animal_home][date]" value="{{ old('[animal_home][date]') or '' }}" class="form-control datetime-not-inline" value="">
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Observaciones</label>
                                    <textarea name="meta[temporary_home][text]" class="form-control" rows="5">{{ old('[temporary_home][text]') or '' }}</textarea>
                                </div>
                            </div>
                            <div id="street-form" {!! old('location') == 'street' ? 'style="display:block"' : '' !!}>
                                <h4 style="margin-top: 50px; margin-bottom: 0">Rellene los datos <small>(ningún campo es obligatorio)</small></h4>
                                <div class="form-group">
                                    <label for="" class="control-label">Observaciones</label>
                                    <textarea name="meta[street][text]" class="form-control" rows="5">{{ old('[street][text]') or '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('birth_date') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.birth_date')) }}</label>
                        <div class="col-md-10">
                            <p><label><input type="checkbox" name="birth_date_approximate" value="1"> &nbsp;&nbsp;Fecha aproximada</label></p>
                            <input type="text" name="birth_date" value="{{ date('Y-m-d') }}" class="form-control datetime" required>
                            {!! $errors->first('birth_date', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('entry_date') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.entry_date')) }}</label>
                        <div class="col-md-10">
                            <p><label><input type="checkbox" name="entry_date_approximate" value="1"> &nbsp;&nbsp;Fecha aproximada</label></p>
                            <input type="text" name="entry_date" value="" class="form-control datetime-not-inline">
                            {!! $errors->first('entry_date', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has($langform . '.breed') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.breed')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="{{ $langform }}[breed]" class="form-control">
                            {!! $errors->first($langform .'.breed"', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.weight')) }}</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="number" name="weight" value="{{ old('weight') }}" step="0.01" class="form-control">
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
                                <input type="number" name="height" value="{{ old('height') }}" class="form-control">
                                <span class="input-group-addon">cm</span>
                            </div>
                            {!! $errors->first('height', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('length') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.length')) }}</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="number" name="length" value="{{ old('length') }}" class="form-control">
                                <span class="input-group-addon">cm</span>
                            </div>
                            {!! $errors->first('length', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has($langform . '.health_text') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.health')) }}<br></label>
                        <div class="col-md-10">
                            <input type="text" name="{{ $langform }}[health_text]" class="form-control">
                            {!! $errors->first($langform .'.health_text"', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has($langform . '.private_text') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.private_text')) }}<br><small>(Información sobre el animal sólo disponible para voluntarios)</small></label>
                        <div class="col-md-10">
                            <textarea name="{{ $langform }}[private_text]" class="form-control tinymce"></textarea>
                            {!! $errors->first($langform .'.private_text"', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has($langform . '.text') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.description')) }}</label>
                        <div class="col-md-10">
                            <textarea name="{{ $langform }}[text]" class="form-control tinymce"></textarea>
                            {!! $errors->first($langform .'.text"', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-5 col-md-2">
                                <input type="submit" class="btn btn-block btn-primary" value="Crear ficha">
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
    <p>En esta página se puede crear la ficha de un animal.</p>
    <p class="bg-info">Las fotos se podrán añadir una vez se haya creado la ficha.</p>
    <p>Si habilita las casillas "Fecha aproximada" lo que hace es aproximarse a la fecha. Por ejemplo, si un animal tiene 5 meses y 20 días, solo aparecerá 5 meses. Otro ejemplo, si un animal tiene 1 año y 5 meses, solo aparecerá 1 año.</p>

    <h4>Campos del formulario</h4>
    <p><strong>Identificador:</strong><br> Identificador interno que usan algunas protectoras para identificar a sus animales.</p>
    <p><strong>Camada:</strong><br> Identificador de la camada.</p>
    <p><strong>Visible en la web:</strong><br> Indica si el animal puede ser visible en la web, ya sea en los listados o su ficha.</p>
    <p><strong>Salud:</strong><br> Breve resumen de la salud del animal.</p>
    <p><strong>Texto privado:</strong><br> Este campo puede ser útil para dejar notas del animal internamente. Este campo no es público.</p>
@stop