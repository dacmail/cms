@extends('install.layouts.base')

@section('content')

	<h4>Bienvenid@ a la instalación de ProteCMS.</h4><br>

	<p>Si estás viendo esta página es que vuestra protectora está a unos pasos de tener su propia página web.</p>
	<p>Ahora solo tienes que ir completando los pasos para finalizar. Una vez finalices la instalación se enviará un mensaje con los datos de acceso al correo electrónico de la protectora que hayas introducido.</p>
	<p>Si tienes cualquier duda durante el proceso, no dudes en ponerte en <a href="http://protecms.com/#contact" target="_blank">contacto</a>.</p>
	<p>Para continuar introduce el código de seguridad que has recibido en el correo electrónico del alta.</p>

	<div class="col-md-offset-3 col-md-6">
		<form action="{{ route('install::data') }}">
			<div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
				<label for="" class="control-label text-left">Código de seguridad</label>
				<input type="text" class="form-control" name="code" value="{{ Request::get('code') }}">
				{!! $errors->first('code', '<span class="help-block text-left">:message</span>') !!}
			</div>
			<button type="submit" class="btn btn-success btn-block btn-block">Empezar</button>
		</form>
	</div>

@stop