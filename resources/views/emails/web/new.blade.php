@extends('emails.layouts.base')

@section('title')
    ¡La página de tu protectora ya está lista!
@stop

@section('content')
    <p>La página web de vuestra protectora se ha generado correctamente y ya podéis empezar a configurarla, subir las fichas de los animales, publicar artículos y demás.</p>
    <p>Los datos de la protectora son:</p>
    <strong>Nombre: </strong>{{ $web->name }}<br>
    <strong>Correo electrónico: </strong>{{ $web->email }}<br>
    <strong>Fecha del alta: </strong>{{ date('d-m-Y H:i') }}<br>
    <p>Datos de acceso:</p>
    <strong>Página web: </strong><a href="{{ route('web::index') }}">{{ route('web::index') }}</a><br>
    <strong>Panel de administración: </strong><a href="{{ route('admin::panel::index') }}">{{ route('admin::panel::index') }}</a><br>
    <strong>Correo electrónico: </strong>{{ $web->email }}<br>
    <strong>Contraseña: </strong>{{ $password }}<br>
    <br>
    <p>Muchas gracias por confiar en el proyecto. Cualquier duda que tengas no dudes en ponerte en contacto. Puedes hacerlo en el panel de administración, en la sección Soporte.</p>
    <p>Ya solo queda que disfrutéis de proyecto y que os sea realmente de utilidad, ya que el proyecto es para vosotros. ¡Gracias por salvar vidas! Sois héroes.</p>
    <p>Un saludo,<br>Jaime Sares.</p>
    <br>
    <img src="http://protecms.com/images/logos/logo_original@0.75x.png" width="148px" height="114px" style="margin:0 auto; padding:0; border:none; display:block;" border="0" class="imgClass" alt="" />
@stop
