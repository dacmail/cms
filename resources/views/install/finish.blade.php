@extends('install.layouts.base')

@section('progress')
	<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
	Instalación completada
	</div>
@stop

@section('content')

	<div class="text-left">
		<h4>¡Instalación finalizada!</h4>
		<p>Has completado todos los pasos con éxito. La página web se ha generado correctamente.</p>
		<p>Ya puedes acceder al panel de administración los datos generados que verás debajo. También los recibiréis en el correo electrónico de la protectora.</p>
		<br>
		<p style="text-decoration: underline;">Datos de la protectora:</p>
		<p><strong>Nombre:</strong> {{ $web->name }}</p>
		<p><strong>Página web:</strong> <a href="{{ $web->getUrl() }}">{{ $web->getUrl() }}</a></p>
		<p><strong>Correo electrónico:</strong> {{ $web->email }}</p>
		<br>
		<p style="text-decoration: underline;">Datos de acceso:</p>
		<p><strong>Correo electrónico:</strong> {{ $web->email }}</p>
		<p><strong>Contraseña:</strong> {{ $password }}</p>
		<br><small>La contraseña se ha generado aleatoriamente y se ha almacenado de forma segura en el servidor. En el panel de administración podrás cambiarla.</small>
		<br>
		<p>¡Y eso es todo! Muchas gracias por confiar en el proyecto. <br>Ahora puedes:</p>

		<div class="col-md-offset-3 col-md-6" style="margin-top: 50px">
			<a href="{{ route('web::index') }}" class="btn btn-success btn-block">Ir a la página web</a>
			<a href="{{ route('admin::panel::index') }}" class="btn btn-success btn-block">Ir al panel de administración</a>
		</div>
	</div>

@stop