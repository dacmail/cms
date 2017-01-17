@extends('admin.layouts.base')

@section('page.title')
    Editando: {{ $user->name }}<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::users::index') }}">Usuarios</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::users::edit', ['id' => $user->id]) }}">{{ $user->name }}</a>
    </li>
@stop

@section('content')
    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form action="{{ route('admin::panel::users::update', ['id' => $user->id]) }}" method="POST" class="form-horizontal form-bordered form-label-stripped">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.name')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="name" value="{{ $user->name }}" class="form-control" required>
                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.email')) }}</label>
                    <div class="col-md-10">
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control" required>
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.password')) }}</label>
                    <div class="col-md-10">
                        <input type="password" name="password" value="" class="form-control" autocomplete="off">
                        <div class="help-block">Dejar en blanco para mantener la actual</div>
                        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.password_confirmation')) }}</label>
                    <div class="col-md-10">
                        <input type="password" name="password_confirmation" value="" class="form-control" autocomplete="off">
                        {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.status')) }}</label>
                    <div class="col-md-10">
                        <select name="status" class="form-control" placeholder="Estado...">
                            @foreach(config('protecms.users.status') as $status)
                                <option value="{{ $status }}" {{ $status == $user->status ? 'selected' : '' }}>{{ trans('users.status.' . $status) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.type')) }}</label>
                    <div class="col-md-10">
                        <select name="type" class="form-control select-type">
                            @foreach(config('protecms.users.type') as $type)
                                <option value="{{ $type }}" {{ $type == $user->type ? 'selected' : '' }}>{{ trans('users.type.' . $type) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>

                <div class="form-group form-group-permissions {{ $errors->has('permissions') ? 'has-error' : '' }} {{ $user->type == 'user' ? 'hide' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.permissions')) }}</label>
                    <div class="col-md-10">
                        <p class="bg-info text-center alert-admin {{ ! $user->isAdmin() ? 'hide' : '' }}">
                            Los usuarios administradores tienen acceso total a todas las secciones.
                        </p>
                        <div class="permissions {{ $user->isAdmin() ? 'hide' : '' }}">
                            <h4>Permisos generales <span class="btn btn-default all-permissions-general pull-right" style="margin-left: 5px">Permitir todo</span><span class="btn btn-default delete-permissions-general pull-right">No permitir</span></h4>

                            <div class="permissions-general">
                                <div class="col-md-4">
                                    <label for="" class="control-label">Panel de administración</label>
                                    <select name="permissions[admin]" id="" class="form-control select-permissions">
                                        <option value="0">Sin acceso</option>
                                        <option value="1" {{ $user->hasPermission('admin') ? 'selected' : '' }}>Con acceso</option>
                                    </select>
                                </div>
                                <div class="permissions-list" {{ ! $user->hasPermission('admin') ? 'style=display:none' : '' }}>
                                    <div class="col-md-4">
                                        <label for="permissions[admin.panel.stats]" class="control-label">Estadísticas</label>
                                        <select name="permissions[admin.panel.stats]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.panel.stats') ? 'selected' : '' }}>Con acceso</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Calendario</label>
                                        <select name="permissions[admin.calendar]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.calendar') ? 'selected' : '' }}>Acceso total</option>
                                            <option value="view" {{ $user->hasPermission('admin.calendar.view') ? 'selected' : '' }}>Solo ver</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Finanzas</label>
                                        <select name="permissions[admin.finances]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.finances') ? 'selected' : '' }}>Acceso total</option>
                                            <option value="view" {{ $user->hasPermission('admin.finances.view') ? 'selected' : '' }}>Solo ver</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Diseño</label>
                                        <select name="permissions[admin.design]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.design') ? 'selected' : '' }}>Acceso total</option>
                                            <option value="view" {{ $user->hasPermission('admin.design.view') ? 'selected' : '' }}>Solo ver</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Soporte</label>
                                        <select name="permissions[admin.support]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.support') ? 'selected' : '' }}>Con acceso</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Artículos</label>
                                        <select name="permissions[admin.panel.posts]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.panel.posts') ? 'selected' : '' }}>Acceso total</option>
                                            <option value="view" {{ $user->hasPermission('admin.panel.posts.view') ? 'selected' : '' }}>Solo ver</option>
                                            <option value="crud" {{ $user->hasPermission('admin.panel.posts.crud') ? 'selected' : '' }}>Crear, actualizar y eliminar (propios)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Páginas</label>
                                        <select name="permissions[admin.panel.pages]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.panel.pages') ? 'selected' : '' }}>Acceso total</option>
                                            <option value="view" {{ $user->hasPermission('admin.panel.pages.view') ? 'selected' : '' }}>Solo ver</option>
                                            <option value="crud" {{ $user->hasPermission('admin.panel.pages.crud') ? 'selected' : '' }}>Crear, actualizar y eliminar (propios)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Formularios</label>
                                        <select name="permissions[admin.panel.forms]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.panel.forms') ? 'selected' : '' }}>Acceso total</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Archivos</label>
                                        <select name="permissions[admin.panel.files]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.panel.files') ? 'selected' : '' }}>Acceso total</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Usuarios</label>
                                        <select name="permissions[admin.panel.users]" id="" class="form-control">
                                            <option value="0" {{ $user->hasPermission('admin.panel.users') ? 'selected' : '' }}>Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.panel.users') ? 'selected' : '' }}>Acceso total</option>
                                            <option value="view" {{ $user->hasPermission('admin.panel.users.view') ? 'selected' : '' }}>Solo ver</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Socios</label>
                                        <select name="permissions[admin.panel.partners]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.panel.partners') ? 'selected' : '' }}>Acceso total</option>
                                            <option value="view" {{ $user->hasPermission('admin.panel.partners.view') ? 'selected' : '' }}>Solo ver</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Veterinarios</label>
                                        <select name="permissions[admin.panel.veterinarians]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.panel.veterinarians') ? 'selected' : '' }}>Acceso total</option>
                                            <option value="view" {{ $user->hasPermission('admin.panel.veterinarians.view') ? 'selected' : '' }}>Solo ver</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Casas de acogida</label>
                                        <select name="permissions[admin.panel.temporaryhomes]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.panel.temporaryhomes') ? 'selected' : '' }}>Acceso total</option>
                                            <option value="view" {{ $user->hasPermission('admin.panel.temporaryhomes.view') ? 'selected' : '' }}>Solo ver</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="clearfix"></div>

                            <div class="permissions-animals-list" {{ ! $user->hasPermission('admin') ? 'style=display:none' : '' }}>
                                <h4 style="margin-top: 50px">Permisos de los animales <span class="btn btn-default all-permissions-animals pull-right" style="margin-left: 5px">Permitir todo</span><span class="btn btn-default delete-permissions-animals pull-right">No permitir</span></h4>
                                <div class="col-md-4">
                                    <label for="" class="control-label">Animales</label>
                                    <select name="permissions[admin.panel.animals]" id="" class="form-control select-permissions-animals">
                                        <option value="0">Sin acceso</option>
                                        <option value="1" {{ $user->hasPermission('admin.panel.animals') ? 'selected' : '' }}>Con acceso</option>
                                    </select>
                                </div>
                                <div class="permissions-animals" {{ ! $user->hasPermission('admin.panel.animals') ? 'style=display:none' : '' }}>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Perros</label>
                                        <select name="permissions[admin.panel.animals.dog]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.panel.animals.dog') ? 'selected' : '' }}>Acceso total</option>
                                            <option value="view" {{ $user->hasPermission('admin.panel.animals.dog.view') ? 'selected' : '' }}>Solo ver</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Gatos</label>
                                        <select name="permissions[admin.panel.animals.cat]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.panel.animals.cat') ? 'selected' : '' }}>Acceso total</option>
                                            <option value="view" {{ $user->hasPermission('admin.panel.animals.cat.view') ? 'selected' : '' }}>Solo ver</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Equinos</label>
                                        <select name="permissions[admin.panel.animals.horse]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.panel.animals.horse') ? 'selected' : '' }}>Acceso total</option>
                                            <option value="view" {{ $user->hasPermission('admin.panel.animals.horse.view') ? 'selected' : '' }}>Solo ver</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Roedores</label>
                                        <select name="permissions[admin.panel.animals.rodent]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.panel.animals.rodent') ? 'selected' : '' }}>Acceso total</option>
                                            <option value="view" {{ $user->hasPermission('admin.panel.animals.rodent.view') ? 'selected' : '' }}>Solo ver</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Aves</label>
                                        <select name="permissions[admin.panel.animals.bird]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.panel.animals.bird') ? 'selected' : '' }}>Acceso total</option>
                                            <option value="view" {{ $user->hasPermission('admin.panel.animals.bird.view') ? 'selected' : '' }}>Solo ver</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Reptiles</label>
                                        <select name="permissions[admin.panel.animals.reptil]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.panel.animals.reptil') ? 'selected' : '' }}>Acceso total</option>
                                            <option value="view" {{ $user->hasPermission('admin.panel.animals.reptil.view') ? 'selected' : '' }}>Solo ver</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="control-label">Otros</label>
                                        <select name="permissions[admin.panel.animals.other]" id="" class="form-control">
                                            <option value="0">Sin acceso</option>
                                            <option value="1" {{ $user->hasPermission('admin.panel.animals.other') ? 'selected' : '' }}>Acceso total</option>
                                            <option value="view" {{ $user->hasPermission('admin.panel.animals.other.view') ? 'selected' : '' }}>Solo ver</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
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
@stop

@push('scripts')
<script>
    $('.select-type').on('change', function() {

        $('.alert-admin').addClass('hide');

        $('.form-group-permissions').removeClass('hide');
        if ($('.select-type option:selected').val() === 'user') {
            $('.form-group-permissions').addClass('hide');
        } else if ($('.select-type option:selected').val() === 'volunteer') {
            $('.permissions').removeClass('hide');
        } else if ($('.select-type option:selected').val() === 'admin') {
            $('.alert-admin').removeClass('hide');
            $('.permissions').addClass('hide');
        }

    });

    $('.select-permissions').on('change', function() {
        if ($('.select-permissions option:selected').val() === '1') {
            $('.permissions-list').fadeIn();
            $('.permissions-animals-list').fadeIn();
        } else {
            $('.permissions-list').fadeOut();
            $('.permissions-animals-list').fadeOut();
        }
    });

    $('.select-permissions-animals').on('change', function() {
        if ($('.select-permissions-animals option:selected').val() === '1') {
            $('.permissions-animals').fadeIn();
        } else {
            $('.permissions-animals').fadeOut();
        }
    });

    $('.all-permissions-general').on('click', function(e) {
        $('.permissions-list').fadeIn();
        $('.permissions-animals-list').fadeIn();
        $('.permissions-general select').each(function() {
            $(this).val(1);
        });
    });

    $('.all-permissions-animals').on('click', function(e) {
        $('.select-permissions-animals').val(1);
        $('.permissions-animals').fadeIn();
        $('.permissions-animals select').each(function() {
            $(this).val(1);
        });
    });

    $('.delete-permissions-general').on('click', function(e) {
        $('.permissions-list').fadeOut();
        $('.permissions-animals-list').fadeOut();
        $('.permissions-general select').each(function() {
            $(this).val(0);
        });
        $('.select-permissions-animals').val(0);
        $('.permissions-animals select').each(function() {
            $(this).val(0);
        });
    });

    $('.delete-permissions-animals').on('click', function(e) {
        $('.select-permissions-animals').val(0);
        $('.permissions-animals').fadeOut();
        $('.permissions-animals select').each(function() {
            $(this).val(0);
        });
    });
</script>
@endpush

@section('page.help.text')
    <p>En esta página se puede editar un usuario en la protectora.</p>
    <p class="bg-info">Los usuarios de tipo Usuario no tienen permisos de ningún tipo, los voluntarios tienen permisos específicos y los administradores tienen todos los permisos.</p>

    <h4>Campos del formulario</h4>
    <p><strong>Estado:</strong><br> Si un usuario está bloqueado o inactivo, no puede acceder al panel ni realizar ninguna acción. Si está pendiente es que aún no ha confirmado su registro.</p>
    <p><strong>Notificación:</strong><br> Indica si al registrar un usuario, este recibirá un correo electrónico con sus datos de acceso.</p>
@stop
