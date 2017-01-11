@extends('admin.layouts.base')

@section('page.title')
    {{ str_limit($finances->title, 70, '...') }}
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::finances::index') }}">Finanzas</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::finances::show', ['id' => $finances->id]) }}">{{ str_limit($finances->title, 70, '...') }}</a>
    </li>
@stop

@section('content')
    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form action="{{ route('admin::finances::update', ['id' => $finances->id]) }}" method="POST" class="form-horizontal form-bordered form-label-stripped" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.title')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ $finances->title }}</p>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.amount')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ $finances->amount }}</p>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('executed_at') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.executed_at')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ $finances->executed_at->format('d-m-Y H:i:s') }}</p>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.type')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ trans('finances.type.' . $finances->type) }}</p>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('reason') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.reason')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ trans('finances.reason.' . $finances->reason) }}</p>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.description')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{!! $finances->description !!}</p>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <a href="{{ route('admin::finances::index') }}" class="btn btn-block btn-primary">Volver al listado</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
