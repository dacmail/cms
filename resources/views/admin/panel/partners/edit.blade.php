@extends('admin.layouts.base')

@section('page.title')
    Editando: {{ $partner->name }}<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::partners::index') }}">Socios</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::partners::edit', ['id' => $partner->id]) }}">{{ $partner->name }}</a>
    </li>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered form-fit">
            <div class="portlet-body form">
                <form action="{{ route('admin::panel::partners::update', ['id' => $partner->id]) }}" method="POST" class="form-horizontal form-bordered form-label-stripped">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.name')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="name" value="{{ $partner->name }}" class="form-control" required>
                            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.email')) }}</label>
                        <div class="col-md-10">
                            <input type="email" name="email" value="{{ $partner->email }}" class="form-control">
                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('donation') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.donation')) }}</label>
                        <div class="col-md-10">
                            <div class="input-group">
                                <input type="number" name="donation" value="{{ $partner->donation }}" class="form-control" required>
                                <div class="input-group-addon">€</div>
                            </div>
                            {!! $errors->first('donation', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.start_date')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="start_date" value="{{ $partner->start_date ? $partner->start_date->format('d-m-Y') : '' }}" class="form-control datetime-not-inline">
                            {!! $errors->first('start_date', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.end_date')) }}</label>
                        <div class="col-md-10">
                            <input type="text" name="end_date" value="{{ $partner->end_date ? $partner->end_date->format('d-m-Y') : '' }}" class="form-control datetime-not-inline">
                            {!! $errors->first('end_date', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('payment_method') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.payment_method')) }}</label>
                        <div class="col-md-10">
                            <select name="payment_method" class="form-control">
                                @foreach(config('protecms.partners.payment_method') as $payment_method)
                                    <option value="{{ $payment_method }}" {{ $partner->payment_method == $payment_method ? 'selected' : '' }}>{{ trans('partners.payment_method.' . $payment_method) }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('payment_method', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('donation_time') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.donation_time')) }}</label>
                        <div class="col-md-10">
                            <select name="donation_time" class="form-control">
                                @foreach(config('protecms.partners.donation_time') as $donation_time)
                                    <option value="{{ $donation_time }}" {{ $partner->donation_time == $donation_time ? 'selected' : '' }}>{{ trans('partners.donation_time.' . $donation_time) }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('donation_time', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.observations')) }}</label>
                        <div class="col-md-10">
                            <textarea name="text" class="form-control tinymce">{{ $partner->text }}</textarea>
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
    <p>En esta página se puede editar un socio de la protectora.</p>

    <p class="bg-info">Todos los datos de los socios son privados, esto quiere decir que no son accesibles de ningún otro sitio salvo el panel de administración.</p>
@stop