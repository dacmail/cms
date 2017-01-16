@extends('admin.layouts.base')

@section('page.title')
    Editando: {{ str_limit($file->title, 40, '...') }}<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::files::index') }}">Archivos</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::files::edit', ['id' => $file->id]) }}">{{ str_limit($file->title, 40, '...') }}</a>
    </li>
@stop

@section('content')
    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form action="{{ route('admin::panel::files::update', ['id' => $file->id]) }}" method="POST" class="form-horizontal form-bordered form-label-stripped" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">Enlace del archivo</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" value="{{ route('web::upload', ['file' => $file->file]) }}" readonly>
                        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.title')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="title" value="{{ $file->title }}" class="form-control" required>
                        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('public') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">
                        * {{ ucfirst(trans('validation.attributes.public')) }}
                        <span data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Indica si el archivo es accesible por cualquier usuario o solo por voluntarios/administradores">
                            <i class="fa fa-info-circle"></i>
                        </span>
                    </label>
                    <div class="col-md-10">
                        <select name="public" class="form-control" required>
                            <option value="1" {{ $file->public ? 'selected' : '' }}>Si</option>
                            <option value="0" {{ ! $file->public ? 'selected' : '' }}>No</option>
                        </select>
                        {!! $errors->first('public', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.author')) }}</label>
                    <div class="col-md-10">
                        <select name="user_id" class="form-control" required>
                            @foreach ($web->volunteers as $user)
                                <option value="{{ $user->id }}" {{ $file->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('user_id', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.file')) }}</label>
                    <div class="col-md-10">

                        <div class="margin-top-10 margin-bottom-40">
                            @if (in_array($file->extension, ['jpg', 'jpeg', 'png', 'gif']))
                                <a href="{{ route('web::upload', ['file' => $file->file]) }}" target="_blank"><img src="{{ route('web::upload', ['file' => $file->file]) }}" alt="" style="max-height: 300px;" class="img-responsive"></a>
                            @else
                                <a href="{{ route('web::upload', ['file' => $file->file]) }}" target="_blank" class="btn btn-default">Abrir archivo</a>
                            @endif
                        </div>

                        <input type="file" name="file" class="form-control">

                        <div class="help-block">El archivo no debe ser mayor de 20MB.<br>Si selecciona otro archivo, el anterior será eliminado.</div>
                        {!! $errors->first('file', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.description')) }}</label>
                    <div class="col-md-10">
                        <textarea name="description" class="form-control tinymce">{{ $file->description }}</textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-5 col-md-2">
                            <input type="submit" class="btn btn-block btn-primary" value="Actualizar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('page.help.text')
    <p>En esta página se puede editar un archivo subido a la protectora.</p>

    <h4>Campos del formulario</h4>
    <p><strong>Público:</strong><br> Indica si el archivo es accesible por cualquier usuario o solo por voluntarios/administradores.</p>
@stop