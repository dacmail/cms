@extends('admin.layouts.base')

@section('page.title')
    Calendario <small>Tareas, eventos, recordatorios...</small>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::calendar::index') }}">Calendario</a>
    </li>
@stop

@section('content')
	<div id="calendar" data-url="{{ route('admin::calendar::calendar', [], false) }}{{ Request::has('type') ? '?type=' . Request::get('type') : '' }}"></div>
    <p>Leyenda:</p>
    <span class="label" style="background:#F44336">{{ trans('calendar.type.transport') }}</span>
    <span class="label" style="background:#9C27B0">{{ trans('calendar.type.revision') }}</span>
    <span class="label" style="background:#2196F3">{{ trans('calendar.type.treatment') }}</span>
    <span class="label" style="background:#4CAF50">{{ trans('calendar.type.work') }}</span>
    <span class="label" style="background:#FF9800">{{ trans('calendar.type.visit') }}</span>
    <span class="label" style="background:#00BCD4">{{ trans('calendar.type.other') }}</span>
    <span class="label" style="background:#C2185B">{{ trans('calendar.type.vaccine') }}</span>
    <br><br>

    <div class="modalCalendar modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Title</h4>
                </div>
                <div class="modal-body">
                    <p>Body</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    @if (Auth::user()->hasPermission('admin.calendar'))
                        <a href="#" class="btn btn-danger pull-left confirm delete-event">Eliminar</a>
                        <a href="#" class="btn btn-info pull-left edit-event">Actualizar</a>
                    @endif
                    <a href="#" class="btn btn-primary go-to-event" target="_blank">Ir al evento</a>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@stop

@section('page.help.text')
    <p>Esta página muestra el calendario de la protectora.</p>
    <p>Aquí aparecen los distintos eventos creados y los registros de salud de los animales que se haya especificado la publicación en el calendario. Se puede ir navegando por días, semanas y meses y en el apartado agenda aparece un resumen de todos los eventos del mes.</p>

    <h4>Permisos</h4>
    <p>En esta página existen dos tipos de permisos: El voluntario puede editar y eliminar un evento o solo puede verlo.</p>
    <p>Si ve estos botones es que tiene acceso a editar y eliminar el evento.</p>
    <p>
        <button class="btn btn-default">Cerrar</button>
        <button class="btn btn-danger">Eliminar</button>
        <button class="btn btn-info">Actualizar</button>
    </p>
    <p>Sin embargo si solo ve el botón de cerrar, es que solo tiene permisos para ver el evento y no para actualizarlo o eliminarlo.</p>

    <h4>Ir al evento</h4>
    <p>Si el evento está relacionado, por ejemplo con la salud de un animal, aparecerá el botón de Ir al evento, que al pulsarlo se irá a la página de edición de la salud.</p>
    <p><button class="btn btn-info">Ir al evento</button></p>   
@stop