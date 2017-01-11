@extends('admin.layouts.base')

@section('page.title')
    Soporte <small>Ayuda, sugerencias y reporte de errores</small>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::support::index') }}">Soporte</a>
    </li>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (count($analytics))
                @foreach ($analytics as $analytic)
                    <p>{{ $analytic['pageTitle'] }}</p>
                @endforeach
            @else
                <div class="alert alert-info text-center">No existen analíticas.</div>
            @endif
        </div>
    </div>
@stop