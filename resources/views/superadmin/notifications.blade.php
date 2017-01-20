@extends('admin.layouts.base')

@section('page.title')
    Notificaciones <small>Envía notificaciones a los usuarios de proyecto</small>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('superadmin::index') }}">SuperAdmin</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('superadmin::notifications') }}">Notificaciones</a>
    </li>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered form-fit">
                <div class="portlet-body form">
                    <form action="{{ route('superadmin::notifications.send') }}" method="POST" class="form-horizontal form-bordered form-label-stripped">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.text')) }}</label>
                            <div class="col-md-10">
                                <input type="text" name="text" value="{{ old('text') }}" class="form-control" required>
                                {!! $errors->first('text', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('link') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.link')) }}</label>
                            <div class="col-md-10">
                                <input type="link" name="link" value="{{ old('link') }}" class="form-control">
                                {!! $errors->first('link', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-4">
                                    <input type="submit" class="btn btn-block btn-primary" value="Enviar notificación">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop