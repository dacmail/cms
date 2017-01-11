@extends('install.layouts.base')

@section('progress')
	<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
	Paso 2 de 5
	</div>
@stop

@section('content')

	<p>Para comenzar, es necesario que introduzcas la información principal de vuestra protectora. Todos los campos son obligatorios.</p>

	<div class="alert alert-info text-center">
		Los datos privados como la dirección o el teléfono <u>no</u> serán públicos. En ninguna circustancia.
	</div>

	<form action="{{ route('install::data_post') }}" method="POST">
		{{ csrf_field() }}

		<h4>Datos de la protectora</h4><br>
		<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
			<label for="name" class="control-label">Nombre de la protectora</label>
			<input type="text" name="name" value="{{ old('name') }}" id="name" class="form-control" required placeholder="Ej. Asociación Defensa Animal">
			{!! $errors->first('name', '<span class="help-block">:message</span>') !!}
		</div>

		<div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
			<label for="description" class="control-label">Descripción de la protectora <small>(En menos de 150 caracteres)</small></label>
			<textarea name="description" id="description" class="form-control" required placeholder="Ej. Somos una protectora de animales ubicada en Huelva que lucha en contra del abandono.">{{ old('description') }}</textarea>
			{!! $errors->first('description', '<span class="help-block">:message</span>') !!}
		</div>

		<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
			<label for="email" class="control-label">Correo electrónico de la protectora</label>
			<input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control" required placeholder="Ej. contacto@protectora.com">
			{!! $errors->first('email', '<span class="help-block">:message</span>') !!}
		</div>

		<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
			<label for="phone" class="control-label">Teléfono de la protectora</label>
			<input type="number" name="phone" id="phone" value="{{ old('phone') }}" class="form-control" required placeholder="Ej. 600 00 00 00">
			{!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
		</div>

		<div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
			<label for="address" class="control-label">Dirección de la protectora <small></small></label>
			<input type="text" name="address" id="address" value="{{ old('address') }}" class="form-control" required placeholder="Ej. Avenida Blas S/N">
			{!! $errors->first('address', '<span class="help-block">:message</span>') !!}
		</div>

		@include('partials.location')

		<hr><br>
		<h4>Otros datos</h4><br>
		<div class="form-group {{ $errors->has('contact_name') ? 'has-error' : '' }}">
			<label for="contact_name" class="control-label">Nombre de la persona de contacto</label>
			<input type="text" name="contact_name" id="contact_name" value="{{ old('contact_name') }}" class="form-control" required placeholder="Ej. Jaime Sares">
			{!! $errors->first('contact_name', '<span class="help-block">:message</span>') !!}
		</div>

		<div class="form-group {{ $errors->has('contact_email') ? 'has-error' : '' }}">
			<label for="contact_email" class="control-label">Correo electrónico de la persona de contacto</label>
			<input type="text" name="contact_email" id="contact_email" value="{{ old('contact_email') }}" class="form-control" required placeholder="Ej. web@protecms.com">
			{!! $errors->first('contact_email', '<span class="help-block">:message</span>') !!}
		</div>

		<div class="form-group">
			<div class="col-md-offset-4 col-md-4" style="margin-top: 50px">
				<button type="submit" class="btn btn-success btn-block">Continuar</button>
			</div>
		</div>

	</form>

@stop
