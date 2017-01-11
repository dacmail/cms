@extends('admin.layouts.base')

@section('page.title')
    Datos de la protectora
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::webs::index') }}">Protectora</a>
    </li>
@stop

@section('content')
    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form action="{{ route('admin::panel::webs::update') }}" method="POST" class="form-horizontal form-bordered form-label-stripped" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                    <h4 class="text-center margin-top-40">Configuración de la protectora</h4>
                </div>
                <div class="form-group {{ $errors->has('subdomain') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.subdomain')) }}</label>
                    <div class="col-md-10">
                        <input type="text" value="{{ $web->subdomain }}" readonly class="form-control" required>
                        <div class="help-block">Si quiere cambiar este parámetro consulte con un administrador.</div>
                        {!! $errors->first('subdomain', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group">
                    <h4 class="text-center margin-top-40">Datos de la protectora</h4>
                </div>
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.name')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="name" value="{{ $web->name }}" class="form-control" required>
                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.description')) }}</label>
                    <div class="col-md-10">
                        <textarea name="description" class="form-control" required>{{ $web->description }}</textarea>
                        {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.email')) }}</label>
                    <div class="col-md-10">
                        <input type="email" name="email" value="{{ $web->email }}" class="form-control" required>
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.phone')) }}</label>
                    <div class="col-md-10">
                        <input type="number" name="phone" value="{{ $web->phone }}" class="form-control" required>
                        {!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.address')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="address" value="{{ $web->address }}" class="form-control" required>
                        {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                @include('admin.layouts.partials.location', [
                    'model' => $web
                ])
                <div class="form-group">
                    <h4 class="text-center margin-top-40">Datos de la persona de contacto</h4>
                </div>
                <div class="form-group {{ $errors->has('contact_name') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.contact_name')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="contact_name" value="{{ $web->contact_name }}" class="form-control" required>
                        {!! $errors->first('contact_name', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('contact_email') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.contact_email')) }}</label>
                    <div class="col-md-10">
                        <input type="email" name="contact_email" value="{{ $web->contact_email }}" class="form-control" required>
                        {!! $errors->first('contact_email', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('contact_phone') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.contact_phone')) }}</label>
                    <div class="col-md-10">
                        <input type="number" name="contact_phone" value="{{ $web->contact_phone }}" class="form-control">
                        {!! $errors->first('contact_phone', '<span class="help-block">:message</span>') !!}
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