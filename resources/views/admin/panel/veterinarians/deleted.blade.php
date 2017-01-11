@extends('admin.layouts.base')

@section('page.title')
    Listado de veterinarios eliminados
    <small><br>(Los veterinarios se eliminarán de forma permanente 30 días después de su eliminación)</small>
    <div class="pull-right"><small>Mostrando {{ $veterinarians->count() }} veterinarios de un total de {{ $total }}.</small></div>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::veterinarians::index') }}">Veterinarios</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::veterinarians::deleted') }}">Eliminadas</a>
    </li>
@stop

@section('content')
    <form action="" method="GET">
        <div class="pull-right">
            Ordenar por <select name="sort" class="margin-bottom-20" onchange="this.form.submit()">
                <option value="name" {{ $request->get('sort') == 'name' ? 'selected' : '' }}>Nombre</option>
                <option value="contact_name" {{ $request->get('sort') == 'contact_name' ? 'selected' : '' }}>Persona de contacto</option>
                
                <option value="email" {{ $request->get('sort') == 'email' ? 'selected' : '' }}>Correo electrónico</option>
            </select>
        </div>
        <div class="table-scrollable">
            <table class="table table-center table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Persona de contacto</th>
                        <th>Correo electrónico</th>
                        <th>Teléfono</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                    <tr>
                        <th><input type="text" name="name" class="form-control" placeholder="Nombre..." value="{{ $request->get('name') }}"></th>
                        <th><input type="text" name="contact_name" class="form-control" placeholder="Persona de contacto..." value="{{ $request->get('contact_name') }}"></th>
                        <th><input type="email" name="email" class="form-control" placeholder="Correo electrónico..." value="{{ $request->get('email') }}"></th>
                        <th><input type="number" name="phone" class="form-control" placeholder="Teléfono..." value="{{ $request->get('phone') }}"></th>
                        <th>
                        <select name="status" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach(config('protecms.veterinarians.status') as $status)
                                <option value="{{ $status }}" {{ $request->get('status') == $status ? 'selected' : '' }}>{{ trans('veterinarians.status.' . $status) }}</option>
                            @endforeach
                        </select>
                        </th>
                        <th>
                            <button type="submit" class="btn btn-block btn-primary">Filtrar</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                @if (count($veterinarians))
                    @foreach ($veterinarians as $veterinary)
                        <tr>
                            <td>{{ $veterinary->name }}</td>
                            <td>{{ $veterinary->contact_name }}</td>
                            <td>{{ $veterinary->email }}</td>
                            <td>{{ $veterinary->phone }}</td>
                            <td>{{ trans('veterinarians.status.' . $veterinary->status) }}</td>
                            <td class="table-actions">
                                <a href="{{ route('admin::panel::veterinarians::restore', ['id' => $veterinary->id]) }}" class="btn btn-primary btn-block confirm" title="Recuperar"><i class="fa fa-history"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">
                            @if ($total)
                                No existen veterinarios con esos parámetros.
                            @else
                                <p class="bg-info text-center">No existen veterinarios eliminados.</p>
                            @endif
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </form>

    {!! $veterinarians->appends($request->all())->links() !!}
@stop