@extends('admin.layouts.base')

@section('page.title')
    CSS Personalizado
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::design::index') }}">Soporte</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::design::css') }}">CSS</a>
    </li>
@stop

@section('content')
    <div class="col-md-12 alert alert-danger text-center">
        Si no entiendes o no sabes que es CSS no hagas ningún cambio en esta sección ya que afectará directamente al diseño de la página web.
    </div>

    <div class="portlet light bordered">
        <div class="portlet-body form">
            <form action="{{ route('admin::design::css::update') }}" method="POST" class="form-bordered form-label-stripped" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group {{ $errors->has('css') ? 'has-error' : '' }}">
                    <label class="control-label">CSS</label>
                    <textarea name="css" class="form-control" rows="20">{{ $web->getConfig('themes.default.css') }}</textarea>
                    {!! $errors->first('css', '<span class="help-block">:message</span>') !!}
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
@stop

@section('page.help.text')
    <p>En esta página se puede añadir CSS personalizado. Esto solo afectará a la visualización de la página web.</p>
    <p class="bg-danger">Por favor, si no tiene conocimientos de CSS, no realice cambios ya que podría afectar gravemente al diseño de la página web.</p>
@stop
