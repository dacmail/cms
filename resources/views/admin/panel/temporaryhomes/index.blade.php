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
                                <p class="bg-info text-center">Aún no se han creado casas de acogida.</p>
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