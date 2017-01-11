@extends('admin.layouts.base')

@section('page.title')
    Subir archivo<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::files::index') }}">Archivos</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::files::create') }}">Subir archivo</a>
    </li>
@stop

@section('content')
    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form action="{{ route('admin::panel::files::store') }}" method="POST" class="form-horizontal form-bordered form-label-stripped" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.title')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="title" value="" class="form-control" required>
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
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                        {!! $errors->first('public', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.author')) }}</label>
                    <div class="col-md-10">
                        <select name="user_id" class="form-control" required>
                            @foreach ($web->volunteers as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('user_id', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('file') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.file')) }}</label>
                    <div class="col-md-10">
                        <input type="file" name="file" class="form-control" required>
                        @if (! $errors->has('file'))
                            <div class="help-block">El archivo no debe ser mayor de 20MB.</div>
                        @endif
                        {!! $errors->first('file', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.description')) }}</label>
                    <div class="col-md-10">
                        <textarea name="description" class="form-control tinymce"></textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <input type="submit" class="btn btn-block btn-primary" value="Subir archivo">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop