@extends('admin.layouts.base')

@section('page.title')
    {{ $user->name }}
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::users::index') }}">Usuarios</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::users::show', ['id' => $user->id]) }}">{{ $user->name }}</a>
    </li>
@stop

@section('content')
    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form class="form-horizontal form-bordered form-label-stripped">
                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.name')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ $user->name }}</p>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.email')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.status')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ trans('users.status.' . $user->status) }}</p>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.type')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ trans('users.type.' . $user->type) }}</p>
                    </div>
                </div>

                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <a href="{{ route('admin::panel::users::index') }}" class="btn btn-block btn-primary">Volver al listado</a>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@stop
