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
	<a href="{{route('admin::finances::create')}}" class="btn btn-primary">Crear registro</a>
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
                    <th>Cantidad</th>
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
                    <th><input type="number" name="amount" class="form-control" placeholder="Cantidad..." value="{{ $request->get('amount') }}"></th>
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
                            <td>{{ $item->amount }}€</td>
                            <td>{{ trans('finances.reason.' . $item->reason) }}</td>
                            <td>
                                <span data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ $item->executed_at->diffForHumans() }}">
                                    {{ $item->executed_at->format('d-m-Y H:i') }}
                                </span>
                            </td>
                            <td class="table-actions">
                                @if (! Auth::user()->isAdmin() && Auth::user()->hasPermission('admin.finances.view'))
                                    <div class="col-md-offset-3 col-md-6 col-xs-12">
                                        <a href="{{ route('admin::finances::show', ['id' => $item->id]) }}" class="btn btn-primary btn-block">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                @else
                                    <div class="col-md-6 col-xs-6">
                                        <a href="{{ route('admin::finances::edit', ['id' => $item->id]) }}" class="btn btn-primary btn-block">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <a href="{{ route('admin::finances::delete', ['id' => $item->id]) }}" class="btn btn-danger btn-block confirm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">
                            @if ($total)
                                No existen registros de finanzas con esos parámetros.
							@else
                                <div class="bg-info text-center">
                                    <p>Aún no se ha creado ningún registro.</p>
                                    <div class="col-md-offset-5 col-md-2"><a href="{{ route('admin::finances::create') }}" class="btn btn-default btn-block" >Crear regisro</a></div>
                                    <div class="clearfix"></div>
                                </div>
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
    <p>Esta página muestra el listado de finanzas de la protectora.</p>
    <p>Se pueden ordenar por fecha y cantidad y se pueden filtrar por título, tipo, cantidad, motivo y fecha.</p>

    <h4>Permisos</h4>
    <p>En esta página existen dos tipos de permisos: El voluntario puede editar y eliminar un registro o solo puede verlo.</p>
    <p>Si ve estos botones es que tiene acceso a editar y eliminar el registro.</p>
    <p>
        <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
    </p>
    <p>Sin embargo si solo ve este botón, es que solo tiene permisos para ver el registro y no para actualizarlo o eliminarlo.</p>
    <p><button class="btn btn-primary"><i class="fa fa-eye"></i></button></p>
@stop