@extends('admin.layouts.base')

@section('page.title')
    Casa de acogida: {{ $temporary_home->name }}<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::temporaryhomes::index') }}">Casas de acogida</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::temporaryhomes::store') }}">{{ $temporary_home->name }}</a>
    </li>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered form-fit">
                <div class="portlet-body form">
                    <form action="{{ route('admin::panel::temporaryhomes::update', ['id' => $temporary_home->id]) }}" method="POST" class="form-horizontal form-bordered form-label-stripped">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.name')) }}</label>
                            <div class="col-md-10">
                                <input type="text" name="name" value="{{ $temporary_home->name }}" class="form-control" required>
                                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.email')) }}</label>
                            <div class="col-md-10">
                                <input type="email" name="email" value="{{ $temporary_home->email }}" class="form-control">
                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.phone')) }}</label>
                            <div class="col-md-10">
                                <input type="text" name="phone" value="{{ $temporary_home->phone }}" class="form-control">
                                {!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.address')) }}</label>
                            <div class="col-md-10">
                                <input type="text" name="address" value="{{ $temporary_home->address }}" class="form-control">
                                {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.status')) }}</label>
                            <div class="col-md-10">
                                <select name="status" class="form-control">
                                    @foreach(config('protecms.temporaryhomes.status') as $status)
                                        <option value="{{ $status }}" {{ $temporary_home->status == $status ? 'selected' : '' }}>{{ trans('temporaryhomes.status.' . $status) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>

                        @include('admin.layouts.partials.location', [
                            'model' => $temporary_home
                        ])

                        <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.observations')) }}</label>
                            <div class="col-md-10">
                                <textarea name="text" class="form-control tinymce">{{ $temporary_home->text }}</textarea>
                                {!! $errors->first('text', '<span class="help-block">:message</span>') !!}
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
        </div>
    </div>
@stop

@section('page.help.text')
    <p>En esta página se puede editar una casa de acogida de la protectora.</p>
    <p class="bg-info">En la ficha del animal se podrá indicar la casa de acogida a la que pertenece.</p>
@stop