@extends('admin.layouts.base')

@section('page.title')
    {{ $partner->name }}
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::partners::index') }}">Socios</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::partners::show', ['id' => $partner->id]) }}">{{ $partner->name }}</a>
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
                            <p class="form-control-static">{{ $partner->name }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.email')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $partner->email or '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('donation') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.donation')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $partner->donation }}€</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.start_date')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $partner->start_date ? $partner->start_date->format('d-m-Y') : '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.end_date')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $partner->end_date ? $partner->end_date->format('d-m-Y') : '-' }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('payment_method') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.payment_method')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ trans('partners.payment_method.' . $partner->payment_method) }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('donation_time') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.donation_time')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ trans('partners.donation_time.' . $partner->donation_time) }}</p>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.observations')) }}</label>
                        <div class="col-md-10">
                            <p class="form-control-static">{{ $partner->text or '-' }}</p>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-4 col-md-4">
                                <a href="{{ route('admin::panel::partners::index') }}" class="btn btn-block btn-primary">Volver al listado</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop