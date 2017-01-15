@extends('admin.layouts.base')

@section('page.title')
    Editar: {{ str_limit($finances->title, 70, '...') }}
    <p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::finances::index') }}">Finanzas</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::finances::edit', ['id' => $finances->id]) }}">{{ str_limit($finances->title, 70, '...') }}</a>
    </li>
@stop

@section('content')
    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form action="{{ route('admin::finances::update', ['id' => $finances->id]) }}" method="POST" class="form-horizontal form-bordered form-label-stripped" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.title')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="title" value="{{ $finances->title }}" class="form-control" required>
                        {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.amount')) }}</label>
                    <div class="col-md-10">
                        <input type="number" name="amount" value="{{ $finances->amount }}" class="form-control" step="0.1" required>
                        {!! $errors->first('amount', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('executed_at') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.executed_at')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="executed_at" value="{{ $finances->executed_at->format('d-m-Y H:i:s') }}" class="form-control datetimepicker" required>
                        {!! $errors->first('executed_at', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.type')) }}</label>
                    <div class="col-md-10">
                        <select name="type" class="form-control">
                            @foreach(config('protecms.finances.type') as $type)
                                <option value="{{ $type }}" {{ $finances->type == $type ? 'selected' : '' }}>{{ trans('finances.type.' . $type) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('reason') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.reason')) }}</label>
                    <div class="col-md-10">
                        <select name="reason" class="form-control">
                            @foreach(config('protecms.finances.reason') as $reason)
                                <option value="{{ $reason }}" {{ $finances->reason == $reason ? 'selected' : '' }}>{{ trans('finances.reason.' . $reason) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('reason', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.description')) }}</label>
                    <div class="col-md-10">
                        <textarea name="description" class="form-control tinymce">{{ $finances->description }}</textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <input type="submit" class="btn btn-block btn-primary" value="Actualizar registro">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('page.help.text')
    <p>En esta página se puede editar un registro en las finanzas de la protectora.</p>
@stop
