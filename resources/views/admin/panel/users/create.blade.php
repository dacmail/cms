@extends('admin.layouts.base')

@section('page.title')
    Registrar usuario<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::users::index') }}">Usuarios</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::users::create') }}">Registrar usuario</a>
    </li>
@stop

@section('content')
    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form action="{{ route('admin::panel::users::store') }}" method="POST" class="form-horizontal form-bordered form-label-stripped">
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.name')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.email')) }}</label>
                    <div class="col-md-10">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.password')) }}</label>
                    <div class="col-md-10">
                        <input type="password" name="password" value="" class="form-control" required autocomplete="off">
                        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.password_confirmation')) }}</label>
                    <div class="col-md-10">
                        <input type="password" name="password_confirmation" value="" class="form-control" required autocomplete="off">
                        {!! $errors->first('password_confirmation', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.status')) }}</label>
                    <div class="col-md-10">
                        <select name="status" class="form-control">
                            @foreach(config('protecms.users.status') as $status)
                                <option value="{{ $status }}" {{ $status == old('status') ? 'selected' : '' }}>{{ trans('users.status.' . $status) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.type')) }}</label>
                    <div class="col-md-10">
                        <select name="type" class="form-control">
                            @foreach(config('protecms.users.type') as $type)
                                <option value="{{ $type }}" {{ $type == old('type') ? 'selected' : '' }}>{{ trans('users.type.' . $type) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('notification') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.notification')) }}</label>
                    <div class="col-md-10">
                        <select name="notification" class="form-control">
                            <option value="yes">Enviar los datos de la cuenta por email</option>
                            <option value="not">No enviar los datos al usuario</option>
                        </select>
                        {!! $errors->first('notification', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>

                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <input type="submit" class="btn btn-block btn-primary" value="Registrar">
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop
