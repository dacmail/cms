@extends('admin.layouts.base')

@section('page.title')
    Nueva protectora
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('superadmin::webs::create') }}">Nueva protectora</a>
    </li>
@stop

@section('content')
    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form action="{{ route('superadmin::webs::store') }}" method="POST" class="form-horizontal form-bordered form-label-stripped" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <h4 class="text-center margin-top-40">Configuración de la protectora</h4>
                </div>
                <div class="form-group {{ $errors->has('domain') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.domain')) }}</label>
                    <div class="col-md-10">
                        <input type="text" value="" name="domain" class="form-control">
                        {!! $errors->first('domain', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('subdomain') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.subdomain')) }}</label>
                    <div class="col-md-10">
                        <input type="text" value="" name="subdomain" class="form-control" required>
                        {!! $errors->first('subdomain', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.email')) }}</label>
                    <div class="col-md-10">
                        <input type="email" value="" name="email" class="form-control" required>
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <input type="submit" class="btn btn-block btn-primary" value="Crear">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop