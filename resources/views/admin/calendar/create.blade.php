@extends('admin.layouts.base')

@section('page.title')
    Nuevo evento<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::calendar::index') }}">Calendario</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::calendar::store') }}">Crear evento</a>
    </li>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered form-fit">
            <div class="portlet-body form">
                <form action="{{ route('admin::calendar::store') }}" method="POST" class="form-horizontal form-bordered form-label-stripped">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.title')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" required>
                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.start_date')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="start_date" value="{{ date('d-m-Y H:i:s') }}" class="form-control datetimepicker">
                            {!! $errors->first('start_date', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.end_date')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="end_date" value="{{ date('d-m-Y H:i:s') }}" class="form-control datetimepicker">
                            {!! $errors->first('end_date', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('all_day') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.all_day')) }}</label>
                        <div class="col-md-10">
                            <select name="all_day" class="form-control" required>
                                <option value="0">No</option>
                                <option value="1">Si</option>
                            </select>
                            {!! $errors->first('all_day', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.type')) }}</label>
                        <div class="col-md-10">
                            <select name="type" class="form-control" required>
                                <option value="" disabled>Seleccione...</option>
                                @foreach(config('protecms.calendar.type') as $type)
                                    <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ trans('calendar.type.' . $type) }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.description')) }}</label>
                        <div class="col-md-10">
                            <textarea name="description" class="form-control tinymce">{{ old('description') }}</textarea>
                            {!! $errors->first('description', '<span class="help-block">:message</span>') !!}
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
    </div>
</div>
@stop