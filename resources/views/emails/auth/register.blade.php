@extends('emails.layouts.base')

@section('title')
    Bienvenido a ProteCMS
@stop

@section('content')
    <p>Un administrador de {{ $web->name }} ha creado tu cuenta con los siguientes datos:</p>
    <p><strong>Nombre:</strong> {{ $user->name }}</p>
    <p><strong>Correo electrónico:</strong> {{ $user->email }}</p>
    <p><strong>Contraseña:</strong> {{ $request->get('password') }}</p>
    <p>Ya puedes acceder a tu cuenta en la web: <a href="{{ $web->getUrl() . '/auth/login' }}">{{ $web->getUrl() . '/auth/login' }}</a></p>
    <br>
    <!-- Start Button -->
    <table width="200" cellpadding="0" cellspacing="0" align="center" border="0">
        <tr>
            <td width="200" height="36" bgcolor="#25c2e6" align="center" valign="middle"
                style="font-family: Arial,Helvetica,sans-serif; font-size: 16px; color: #ffffff;
        line-height:18px;">
                <a href="{{ $web->getUrl() . '/auth/login' }}" target="_blank" alias="" style="text-decoration: none; color: #ffffff;">Acceder al sistema</a>
            </td>
        </tr>
    </table>
    <br>
    <!-- End Button -->
    <p><small>Los datos se han almacenado de forma segura en el sistema. La contraseña generada ha sido encriptada y almacenada.</small></p>
@stop