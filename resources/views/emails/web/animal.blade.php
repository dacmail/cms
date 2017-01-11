@extends('emails.layouts.base')

@section('title')
    Nuevo contacto por {{ $animal->name }}
@stop

@section('content')
    <p><strong>Animal: </strong><a href="{{ $data['link'] }}">(#{{ $animal->id }})</a> {{ $animal->name }}</p>
    <p><strong>Fecha: </strong>{{ date('d-m-Y H:i') }}</p>
    <p><strong>Asunto: </strong>{{ $data['subject'] }}</p>
    <p><strong>Nombre: </strong>{{ $data['name'] }}</p>
    <p><strong>Correo electrónico: </strong>{{ $data['email'] }}</p>
    <p><strong>Teléfono: </strong>{{ $data['phone'] }}</p>
    <p><strong>Mensaje: </strong></p>
    <p>{{ $data['message'] }}</p>
@stop