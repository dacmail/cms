@extends('admin.layouts.base')

@section('page.title')
    Nuevo veterinario<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::veterinarians::index') }}">Veterinarios</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::veterinarians::store') }}">Nuevo veterinario</a>
    </li>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered form-fit">
            <div class="portlet-body form">
                <form action="{{ route('admin::panel::veterinarians::store') }}" method="POST" class="form-horizontal form-bordered form-label-stripped">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.name')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('contact_name') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.contact_name')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="contact_name" value="{{ old('contact_name') }}" class="form-control" required>
                            {!! $errors->first('contact_name', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.email')) }}</label>
                        <div class="col-md-10">
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.phone')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                            {!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('emergency_phone') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.emergency_phone')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="emergency_phone" value="{{ old('emergency_phone') }}" class="form-control">
                            {!! $errors->first('emergency_phone', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.address')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="address" value="{{ old('address') }}" class="form-control">
                            {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.status')) }}</label>
                        <div class="col-md-10">
                            <select name="status" class="form-control">
                                @foreach(config('protecms.veterinarians.status') as $status)
                                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ trans('veterinarians.status.' . $status) }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>

                    @include('admin.layouts.partials.location')

                    <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.observations')) }}</label>
                        <div class="col-md-10">
                            <textarea name="text" class="form-control tinymce">{{ old('text') }}</textarea>
                            {!! $errors->first('text', '<span class="help-block">:message</span>') !!}
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

@section('page.help.text')
    <p>En esta página se puede añadir un veterinario a la protectora.</p>
@stop