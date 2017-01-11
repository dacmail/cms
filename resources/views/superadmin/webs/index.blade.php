@extends('admin.layouts.base')

@section('page.title')
    Listado de protectoras <div class="pull-right"><small>Mostrando {{ $webs->count() }} protectoras de un total de {{ $total }}.</small></div>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::users::index') }}">Usuarios</a>
    </li>
@stop

@section('content')
    <form action="" method="GET">
        <div class="pull-right">
            Ordenar por <select name="sort" class="margin-bottom-20" onchange="this.form.submit()">
                <option value="-updated_at" {{ $request->get('sort') == '-updated_at' ? 'selected' : '' }}>Última actualización</option>
                <option value="name" {{ $request->get('sort') == 'name' ? 'selected' : '' }}>Nombre</option>
                <option value="email" {{ $request->get('sort') == 'email' ? 'selected' : '' }}>Correo electrónico</option>
                <option value="subdomain" {{ $request->get('sort') == 'subdomain' ? 'selected' : '' }}>Subdominio</option>
                <option value="-created_at" {{ $request->get('sort') == '-created_at' ? 'selected' : '' }}>Registro</option>
                <option value="created_at" {{ $request->get('sort') == 'created_at' ? 'selected' : '' }}>Registro (inversa)</option>
                <option value="updated_at" {{ $request->get('sort') == 'updated_at' ? 'selected' : '' }}>Última actualización (inversa)</option>
            </select>
        </div>
        <div class="table-scrollable">
            <table class="table table-center table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo electrónico</th>
                        <th>Subdominio</th>
                        <th>Última actualización</th>
                        <th>Acciones</th>
                    </tr>
                    <tr>
                        <th><input type="text" name="name" class="form-control" placeholder="Nombre..." value="{{ $request->get('name') }}"></th>
                        <th><input type="text" name="email" class="form-control" placeholder="Correo electrónico..." value="{{ $request->get('email') }}"></th>
                        <th><input type="text" name="subdomain" class="form-control" placeholder="Subdominio..." value="{{ $request->get('subdomain') }}"></th>
                        <th><input type="text" name="updated_at" class="form-control datetimerange" placeholder="Fecha de actualización..." value="{{ $request->get('updated_at') }}"></th>
                        <th>
                            <button type="submit" class="btn btn-block btn-primary">Filtrar</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                @if (count($webs))
                    @foreach ($webs as $w)
                        <tr>
                            <td>{{ $w->name or '-' }}</td>
                            <td>{{ $w->email }}</td>
                            <td>{{ $w->subdomain }}</td>
                            <td>{{ $w->updated_at->format('d-m-Y H:i') }}</td>
                            <td class="table-actions">
                                <div class="col-md-12 col-xs-12">
                                    <a href="{{ route('superadmin::webs::edit', ['id' => $w->id]) }}" class="btn btn-primary btn-block">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">
                            @if ($total)
                                No existen protectoras con esos parámetros.
                            @else
                                <p class="bg-info text-center">Aún no se ha creado ningún usuario.</p>
                            @endif
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </form>

    {!! $webs->appends($request->all())->links() !!}
@stop