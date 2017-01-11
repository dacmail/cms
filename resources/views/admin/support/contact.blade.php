@extends('admin.layouts.base')

@section('page.title')
    Enviar mensaje<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::support::index') }}">Soporte</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
    	<a href="{{ route('admin::support::contact') }}">Contacto</a>
    </li>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered form-fit">
            <div class="portlet-body form">
                <form action="{{ route('admin::support::contact_post') }}" method="POST" class="form-horizontal form-bordered form-label-stripped" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.title')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="title" value="" class="form-control" required>
                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.subject')) }}</label>
                        <div class="col-md-10">
                            <select name="subject" required class="form-control">
                                <option value="error">Reportar error</option>
                                <option value="suggestion">Sugerencia</option>
                                <option value="other">Otro</option>
                            </select>
                            {!! $errors->first('subject', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.message')) }}</label>
                        <div class="col-md-10">
                            <textarea name="message" class="form-control tinymce"></textarea>
                            {!! $errors->first('message', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('attachments') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.attachments')) }}</label>
                        <div class="col-md-10">
                            <input type="file" name="attachments[]" multiple class="form-control">
                            {!! $errors->first('attachments', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-4">
                                <input type="submit" class="btn btn-block btn-primary" value="Enviar mensaje">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop