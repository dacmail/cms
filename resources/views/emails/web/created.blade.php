@extends('emails.layouts.base')

@section('title')
    ¡Bienvenidos a ProteCMS!
@stop

@section('content')
    <p>Antes de nada daros la bienvenida al proyecto de ProteCMS. ProteCMS es un proyecto <strong>gratuito</strong> que da la posibilidad a las protectoras o refugios <strong>sin ánimo de lucro</strong> tener una página web.</p>
    <p>Se ha generado la página de vuestra protectora, pero todavía no está lista. Para finalizar la instalación tenéis que hacer clic en el botón que está debajo que os llevará a la página de instalación. Una vez hayáis completado los 5 rápidos pasos se generará automáticamente la página web.</p>
    <p>El código de seguridad generado es: <strong>{{ $install_code }}</strong></p>

    <table width="200" cellpadding="0" cellspacing="0" align="center" border="0">
        <tr>
            <td width="200" height="36" bgcolor="#000000" align="center" valign="middle"
                style="font-family: Arial,Helvetica,sans-serif; font-size: 16px; color: #ffffff;
        line-height:18px;">
                <a href="{{ $web->getUrl() }}" target="_blank" alias="" style="text-decoration: none; color: #ffffff;">Completar instalación</a>
            </td>
        </tr>
    </table>

    <p>Muchas gracias por confiar en el proyecto. Cualquier duda que tengáis no dudes en ponerte en contacto conmigo.</p>
    <p>Un saludo,<br>Jaime Sares.</p>
    <br>
    <img src="http://protecms.com/images/logos/logo_original@0.75x.png" width="148px" height="114px" style="margin:0 auto; padding:0; border:none; display:block;" border="0" class="imgClass" alt="" />
@stop
