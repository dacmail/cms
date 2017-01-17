@extends('admin.layouts.base')

@section('page.title')
    Finanzas <div class="pull-right"><small>Mostrando {{ $finances->count() }} registros de un total de {{ $total }}.</small></div>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::finances::index') }}">Finanzas</a>
    </li>
@stop

@section('content')
    <form action="" method="GET">
        <div class="pull-right">
            Ordenar por <select name="sort" class="margin-bottom-20" onchange="this.form.submit()">
                <option value="-executed_at" {{ $request->get('sort') == '-executed_at' ? 'selected' : '' }}>Fecha</option>
                <option value="amount" {{ $request->get('sort') == 'amount' ? 'selected' : '' }}>Cantidad</option>
                <option value="-amount" {{ $request->get('sort') == '-amount' ? 'selected' : '' }}>Cantidad (inversa)</option>
                
            </select>
        </div>
        <div class="table-scrollable">
            <table class="table table-center table-striped table-bordered table-condensed table-hover">
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Tipo</th>
                    <th>Motivo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
                <tr>
                    <th><input type="text" name="title" class="form-control" placeholder="Título..." value="{{ $request->get('title') }}"></th>
                    <th>
                        <select name="type" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach(config('protecms.finances.type') as $type)
                                <option value="{{ $type }}" {{ $request->get('type') == $type ? 'selected' : '' }}>{{ trans('finances.type.' . $type) }}</option>
                            @endforeach
                        </select>
                    </th>
                    <th>
                        <select name="reason" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach(config('protecms.finances.reason') as $reason)
                                <option value="{{ $reason }}" {{ $request->get('reason') == $reason ? 'selected' : '' }}>{{ trans('finances.reason.' . $reason) }}</option>
                            @endforeach
                        </select>
                    </th>
                    <th><input type="text" name="executed_at" class="form-control datetimerange" placeholder="Fecha..." value="{{ $request->get('executed_at') }}"></th>
                    <th class="table-actions">
                        <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-search"></i></button>
                    </th>
                </tr>
                </thead>
                <tbody>
                @if (count($finances))
                    @foreach ($finances as $item)
                        <tr>
                            <td>{{ str_limit($item->title, 70, '...') }}</td>
                            <td>{{ trans('finances.type.' . $item->type) }}</td>
                            <td>{{ trans('finances.reason.' . $item->reason) }}</td>
                            <td>
                                <span data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ $item->executed_at->diffForHumans() }}">
                                    {{ $item->executed_at->format('d-m-Y H:i') }}
                                </span>
                            </td>
                            <td class="table-actions">
                                <a href="{{ route('admin::finances::restore', ['id' => $item->id]) }}" class="btn btn-primary btn-block confirm">
                                    <i class="fa fa-history"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">
                            @if ($total)
                                No existen registros eliminados con esos parámetros.
                            @else
                                <p class="bg-info text-center">No existen registros eliminados.</p>
                            @endif
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </form>

    {!! $finances->appends($request->all())->links() !!}
@stop

@section('page.help.text')
    <p>Esta página muestra el listado de las finanzas eliminadas de la protectora.</p>
    <p>Se pueden ordenar por fecha y cantidad y se pueden filtrar por título, tipo, cantidad, motivo y fecha.</p>
    <p>Haciendo clic en el siguiente botón se recuperará el registro y aparecerá en el listado de finanzas.</p>
    <p><button class="btn btn-primary"><i class="fa fa-history"></i></button></p>
    <p class="bg-info">Los registros que permanezcan más de 30 días eliminados, se eliminarán de forma permanente.</p>
@stop