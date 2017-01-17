@extends('admin.layouts.base')

@section('page.title')
    Listado de casas de acogida <div class="pull-right"><small>Mostrando {{ $temporary_homes->count() }} casas de acogida de un total de {{ $total }}.</small></div>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::temporaryhomes::index') }}">Casas de acogida</a>
    </li>
@stop

@section('content')
			    <a href="{{route('admin::panel::temporaryhomes::create')}}" class="btn btn-primary visible-xs-inline-block">Crear casa de acogida</a>
    <form action="" method="GET">
        <div class="pull-right">
            Ordenar por <select name="sort" class="margin-bottom-20" onchange="this.form.submit()">
                <option value="name" {{ $request->get('sort') == 'name' ? 'selected' : '' }}>Nombre</option>
                <option value="email" {{ $request->get('sort') == 'email' ? 'selected' : '' }}>Correo electrónico</option>
            </select>
        </div>
        <div class="table-scrollable">
            <table class="table table-center table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo electrónico</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    <tr>
                        <th><input type="text" name="name" class="form-control" placeholder="Nombre..." value="{{ $request->get('name') }}"></th>
                        <th><input type="email" name="email" class="form-control" placeholder="Correo electrónico..." value="{{ $request->get('email') }}"></th>
                        <th><input type="text" name="phone" class="form-control" placeholder="Teléfono..." value="{{ $request->get('phone') }}"></th>
                        <th>
                        <select name="status" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach(config('protecms.temporaryhomes.status') as $status)
                                <option value="{{ $status }}" {{ $request->get('status') == $status ? 'selected' : '' }}>{{ trans('temporaryhomes.status.' . $status) }}</option>
                            @endforeach
                        </select>
                        </th>
                        <th>
                            <button type="submit" class="btn btn-block btn-primary">Filtrar</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                @if (count($temporary_homes))
                    @foreach ($temporary_homes as $temporary_home)
                        <tr>
                            <td>{{ $temporary_home->name }}</td>
                            <td>{{ $temporary_home->email or '-' }}</td>
                            <td>{{ $temporary_home->phone or '-' }}</td>
                            <td>{{ trans('temporaryhomes.status.' . $temporary_home->status) }}</td>
                            <td class="table-actions">
                                @if (! Auth::user()->isAdmin() && Auth::user()->hasPermission('admin.panel.temporaryhomes.view'))
                                    <div class="col-md-offset-3 col-md-6 col-xs-12">
                                        <a href="{{ route('admin::panel::temporaryhomes::show', ['id' => $temporary_home->id]) }}" class="btn btn-primary btn-block">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                @else
                                    <div class="col-md-6 col-xs-6">
                                        <a href="{{ route('admin::panel::temporaryhomes::edit', ['id' => $temporary_home->id]) }}" class="btn btn-primary btn-block">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <a href="{{ route('admin::panel::temporaryhomes::delete', ['id' => $temporary_home->id]) }}" class="btn btn-danger confirm btn-block">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">
                            @if ($total)
                                No existen casas de acogida con esos parámetros.
							@else
                                <div class="bg-info text-center">
                                    <p>Aún no se ha creado ninguna casa de acogida.</p>
                                    <div class="col-md-offset-5 col-md-2"><a href="{{ route('admin::panel::temporaryhomes::create') }}" class="btn btn-default btn-block" >Crear una</a></div>
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

    {!! $temporary_homes->appends($request->all())->links() !!}
@stop

@section('page.help.text')
    <p>Esta página muestra el listado de casas de acogida de la protectora.</p>
    <p>Se pueden ordenar por nombre y correo electrónico y se pueden filtrar por nombre, correo electrónico, teléfono y estado.</p>

    <h4>Permisos</h4>
    <p>En esta página existen dos tipos de permisos: El voluntario puede editar y eliminar una casa de acogida o solo puede verla.</p>
    <p>Si ve estos botones es que tiene acceso a editar y eliminar casas de acogida.</p>
    <p>
        <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
    </p>
    <p>Sin embargo si solo ve este botón, es que solo tiene permisos para ver casas de acogida y no para actualizarlas o eliminarlas.</p>
    <p><button class="btn btn-primary"><i class="fa fa-eye"></i></button></p>
@stop