@extends('admin.layouts.base')

@section('page.title')
    {{ $veterinary->name }}
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::veterinarians::index') }}">Veterinarios</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::veterinarians::show', ['id' => $veterinary->id]) }}">{{ $veterinary->name }}</a>
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
                            <p class="form-control-static">{{ $veterinary->name }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('contact_name') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.contact_name')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $veterinary->contact_name }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.email')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $veterinary->email or '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.phone')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $veterinary->phone or '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('emergency_phone') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.emergency_phone')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $veterinary->emergency_phone or '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.address')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $veterinary->address or '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.status')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ trans('veterinarians.status.' . $veterinary->status) }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.city')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $veterinary->city->name or '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.state')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $veterinary->state->name or '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.country')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $veterinary->country->name or '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.observations')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{!! $veterinary->text !!}</p>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-5 col-md-2">
                                <a href="{{ route('admin::panel::veterinarians::index') }}" class="btn btn-block btn-primary">Volver al listado</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop