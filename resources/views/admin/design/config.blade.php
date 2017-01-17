@extends('admin.layouts.base')

@section('page.title')
    Configuración<p class="pull-right" style="margin-top:0"><small>Todos los campos son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::design::config') }}">Configuración</a>
    </li>
@stop

@section('content')
    <div class="portlet light bordered">
        <div class="portlet-body form">
            <form action="{{ route('admin::design::config::update') }}" method="POST" class="form-bordered form-label-stripped" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <h4 class="text-center">Configuración de los Artículos</h4>
                </div>
                <div class="form-group">
                    <label class="control-label">Artículos a mostrar en la página principal</label>
                    <select name="posts_pagination" class="form-control">
                        <option value="5" {{ $web->getConfig('posts.pagination') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ $web->getConfig('posts.pagination') == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ $web->getConfig('posts.pagination') == 20 ? 'selected' : '' }}>20</option>
                    </select>
                </div>
                <div class="form-group">
                    <h4 class="text-center margin-top-40">Configuración de los Animales</h4>
                </div>
                <div class="form-group">
                    <label class="control-label">Campos de la ficha a mostrar</label><br>
                    <input type="hidden" name="animals_fields[]" value="name">
                    <label><input type="checkbox" name="animals_fields[]" value="birth_date" {{ in_array('birth_date', json_decode($web->getConfig('animals.fields'))) ? 'checked' : '' }}> Edad</label><br>
                    <label><input type="checkbox" name="animals_fields[]" value="gender" {{ in_array('gender', json_decode($web->getConfig('animals.fields'))) ? 'checked' : '' }}> Género</label><br>
                    <label><input type="checkbox" name="animals_fields[]" value="kind" {{ in_array('kind', json_decode($web->getConfig('animals.fields'))) ? 'checked' : '' }}> Especie</label><br>
                    <label><input type="checkbox" name="animals_fields[]" value="breed" {{ in_array('breed', json_decode($web->getConfig('animals.fields'))) ? 'checked' : '' }}> Raza</label><br>
                    <label><input type="checkbox" name="animals_fields[]" value="status" {{ in_array('status', json_decode($web->getConfig('animals.fields'))) ? 'checked' : '' }}> Estado</label><br>
                    <label><input type="checkbox" name="animals_fields[]" value="location" {{ in_array('location', json_decode($web->getConfig('animals.fields'))) ? 'checked' : '' }}> Localización</label><br>
                    <label><input type="checkbox" name="animals_fields[]" value="weight" {{ in_array('weight', json_decode($web->getConfig('animals.fields'))) ? 'checked' : '' }}> Peso</label><br>
                    <label><input type="checkbox" name="animals_fields[]" value="height" {{ in_array('height', json_decode($web->getConfig('animals.fields'))) ? 'checked' : '' }}> Alto</label><br>
                    <label><input type="checkbox" name="animals_fields[]" value="length" {{ in_array('length', json_decode($web->getConfig('animals.fields'))) ? 'checked' : '' }}> Largo</label><br>
                    <label><input type="checkbox" name="animals_fields[]" value="health_text" {{ in_array('health_text', json_decode($web->getConfig('animals.fields'))) ? 'checked' : '' }}> Salud</label><br>
                </div>
                <div class="form-group {{ $errors->has('animals_contact_email') ? 'has-error' : '' }}">
                    <label class="control-label">Email al que mandar los mensajes de contacto</label>
                    <input type="email" name="animals_contact_email" value="{{ $web->getConfig('animals.contact_email') }}" class="form-control" required>
                    {!! $errors->first('animals_contact_email', '<span class="help-block">:message</span>') !!}
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
@stop

@section('page.help.text')
    <p>Aquí se pueden modificar cosas como la cantidad de artículos a mostrar en la página principal o los campos a mostrar en la ficha de los animales.</p>
    <p class="bg-info">Próximamente se irán añadadiendo más opciones de personalización.</p>
@stop