@extends('admin.layouts.base')

@section('page.title')
    {{ $temporary_home->name }}
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::temporaryhomes::index') }}">Casas de acogida</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::temporaryhomes::show', ['id' => $temporary_home->id]) }}">{{ $temporary_home->name }}</a>
    </li>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered form-fit">
                <div class="portlet-body form">
                    <form class="form-horizontal form-bordered form-label-stripped">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.name')) }}</label>
                            <div class="col-md-10">
                                <p class="form-control-static">{{ $temporary_home->name }}</p>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.email')) }}</label>
                            <div class="col-md-10">
                                <p class="form-control-static">{{ $temporary_home->email or '-' }}</p>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.phone')) }}</label>
                            <div class="col-md-10">
                                <p class="form-control-static">{{ $temporary_home->phone or '-' }}</p>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.address')) }}</label>
                            <div class="col-md-10">
                                <p class="form-control-static">{{ $temporary_home->address or '-' }}</p>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.status')) }}</label>
                            <div class="col-md-10">
                                <p class="form-control-static">{{ trans('temporaryhomes.status.' . $temporary_home->status) }}</p>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.city')) }}</label>
                            <div class="col-md-10">
                                <p class="form-control-static">{{ $temporary_home->city->name or '-' }}</p>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.state')) }}</label>
                            <div class="col-md-10">
                                <p class="form-control-static">{{ $temporary_home->state->name or '-' }}</p>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.country')) }}</label>
                            <div class="col-md-10">
                                <p class="form-control-static">{{ $temporary_home->country->name or '-' }}</p>
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.observations')) }}</label>
                            <div class="col-md-10">
                                <p class="form-control-static">{!! $temporary_home->text or '-' !!}</p>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-4">
                                    <a href="{{ route('admin::panel::temporaryhomes::index') }}" class="btn btn-block btn-primary">Volver al listado</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop