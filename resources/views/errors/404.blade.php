@extends('errors.base')

@section('title')
    @if (! Request::is('/'))
        Página no encontrada.
    @else
        Protectora no encontrada
    @endif
@stop

@section('content')
    @if (! Request::is('/'))
        <p>No se ha encontrado la página que estaba buscando.<br>
        <p>Si crees que se trata de un error, por favor, ponte en contacto con un administrador.</p>

        <p style="margin-top: 40px"><a href="/" class="btn btn-default">Volver a la página principal</a></p>
    @else
        <p>La protectora a la que intentas acceder no existe.<br>
        Si crees que se trata de un error, por favor, ponte en <a href="http://protecms.com/#contact">contacto</a> con un administrador.</p>
        <p>Si eres voluntario de una protectora y quieres que esta sea la página web de tu protectora, haz clic en el siguiente botón.</p>

        <p style="margin-top: 40px"><a href="http://protecms.com/" class="btn btn-default">Crear página para mi protectora</a></p>
        <a href="http://protecms.com"><img src="/assets/images/logos/logo@0.5x.png" alt="ProteCMS" style="max-width: 100px;margin-top:30px"></a>
    @endif
@stop
