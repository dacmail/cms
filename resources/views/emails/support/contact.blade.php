@extends('emails.layouts.base')

@section('title')
    Nuevo mensaje de soporte
@stop

@section('content')
    <p><strong>Título:</strong> {{ $request->get('title') }}</p>
    <p><strong>Fecha:</strong> {{ date('d-m-Y H:i') }}</p>
    <p><strong>Web:</strong> ({{ Auth::user()->web->id }}) {{ Auth::user()->web->name }}</p>
    <p><strong>Usuario:</strong> ({{ Auth::user()->id }}) {{ Auth::user()->name }}</p>
    <p><strong>Título:</strong> {{ $request->get('title') }}</p>
    <p><strong>Asunto:</strong> {{ $request->get('subject') }}</p>
    <p><strong>Mensaje:</strong></p>
    {!! $request->get('message') !!}
    <br>
@stop