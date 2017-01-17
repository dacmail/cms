@extends('admin.layouts.base')

@section('page.title')
    Diseño
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::design::index') }}">Diseño</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::design::widgets::index') }}">Bloques</a>
    </li>
@stop

@section('content')
    <form action="" method="GET">
        <div class="pull-right">
            Ordenar por <select name="sort" class="margin-bottom-20" onchange="this.form.submit()">
                <option value="order" {{ $request->get('sort') == 'order' ? 'selected' : '' }}>Orden</option>
            </select>
        </div>
        <div class="table-scrollable">
            <table class="table table-center table-striped table-bordered table-condensed table-hover">
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Lado</th>
                    <th>Tipo</th>
                    <th>Orden</th>
                    <th>Acciones</th>
                </tr>
                <tr>
                    <th><input type="text" name="translations.title" class="form-control" placeholder="Título..." value="{{ $request->get('translations_title') }}"></th>
                    <th>
                        <select name="side" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach(config('protecms.widgets.side') as $side)
                                <option value="{{ $side }}" {{ $request->get('side') == $side ? 'selected' : '' }}>{{ trans('widgets.side.' . $side) }}</option>
                            @endforeach
                        </select>
                    </th>
                    <th>
                        <select name="type" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach(config('protecms.widgets.type') as $type)
                                <option value="{{ $type }}" {{ $request->get('type') == $type ? 'selected' : '' }}>{{ trans('widgets.type.' . $type) }}</option>
                            @endforeach
                        </select>
                    </th>
                    <th><input type="number" name="order" class="form-control" placeholder="Orden..." value="{{ $request->get('order') }}"></th>
                    <th class="table-actions">
                        <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-search"></i></button>
                    </th>
                </tr>
                </thead>
                <tbody>
                @if (count($widgets))
                    @foreach ($widgets as $widget)
                        <tr>
                            <td>{{ str_limit($widget->title, 70, '...') }}</td>
                            <td>{{ trans('widgets.side.' . $widget->side) }}</td>
                            <td>
                                {{ trans('widgets.type.' . $widget->type) }}
                                @if ($widget->type === 'protecms')
                                    <span data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Los bloques de ProteCMS son bloques complejos que no son modificables por los usuarios (ej. Bloque de animales, buscador...)">
                                        <i class="fa fa-info-circle"></i>
                                    </span>
                                @endif
                            </td>
                            <td>{{  $widget->order }}</td>
                            <td class="table-actions">
                                <div class="col-md-6 col-xs-6">
                                    <a href="{{ route('admin::design::widgets::edit', ['id' => $widget->id]) }}" class="btn btn-primary btn-block">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <a href="{{ route('admin::design::widgets::delete', ['id' => $widget->id]) }}" class="btn btn-danger btn-block confirm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">
                            @if ($total)
                                No existen bloques con esos parámetros.
                            @else
                                <p class="bg-info text-center">Aún no se ha creado ningún bloque.</p>
                            @endif
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </form>

    {!! $widgets->appends($request->all())->links() !!}
@stop

@section('page.help.text')
    <p>Esta página muestra el listado de bloques de la protectora.</p>
    <p>Se pueden ordenar por orden y se pueden filtrar por título, lado, tipo y orden.</p>

    <h4>Permisos</h4>
    <p>En esta página existen dos tipos de permisos: El voluntario puede editar y eliminar un bloque o solo puede verlo.</p>
    <p>Si ve estos botones es que tiene acceso a editar y eliminar el bloque.</p>
    <p>
        <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
    </p>
    <p>Sin embargo si solo ve este botón, es que solo tiene permisos para ver el bloque y no para actualizarlo o eliminarlo.</p>
    <p><button class="btn btn-primary"><i class="fa fa-eye"></i></button></p>
@stop