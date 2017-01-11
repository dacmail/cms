@extends('errors.base')

@section('title')
    Error interno.
@stop

@section('content')
    <p>Ha ocurrido un error interno.<br>
    <p>Si el error continúa, por favor, ponte en <a href="http://protecms.com/#contact">contacto</a> con un administrador.</p>

    @if (! Request::is('/'))
        <p style="margin-top: 40px"><a href="/" class="btn btn-default">Volver a la página principal</a></p>
    @endif
@stop
