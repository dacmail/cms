@extends('emails.layouts.base')

@section('title')
    Reinicio de contraseña
@stop

@section('content')
    <p>
        Hola {{ $user->name }},
    </p>
    <p>
        Debido a la nueva actualización de proyecto tu contraseña se ha vuelto a generar automáticamente. Esto es debido a que se ha actualizado el sistema de encriptación a uno más seguro.
    </p>
    <p>
        Su correo electrónico es: {{ $user->email }}<br>
        Su nueva contraseña es: {{ $password }}
    </p>
    <p>
        Una vez accedas al panel de administración podrás modificarla. Perdón por las molestias ocasionadas.
    </p>
@stop
