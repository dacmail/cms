@extends('emails.layouts.base')

@section('title')
    Nuevo mensaje
@stop

@section('content')
    <p><strong>Formulario: </strong>{{ $form->title }}</p>
    <p><strong>Fecha: </strong>{{ date('d-m-Y H:i') }}</p>
    @foreach ($data as $field => $value)
        <p><strong>{{ $field }}: </strong>{!! $value !!}</p>
    @endforeach
@stop