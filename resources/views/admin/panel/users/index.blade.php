@extends('admin.layouts.base')

@section('page.title')
    Listado de usuarios <div class="pull-right"><small>Mostrando {{ $users->count() }} usuarios de un total de {{ $total }}.</small></div>
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
                <option value="name" {{ $request->get('sort') == 'name' ? 'selected' : '' }}>Nombre</option>
                
                <option value="email" {{ $request->get('sort') == 'email' ? 'selected' : '' }}>Correo electrónico</option>
                <option value="-created_at" {{ $request->get('sort') == '-created_at' ? 'selected' : '' }}>Registro</option>
                <option value="created_at" {{ $request->get('sort') == 'created_at' ? 'selected' : '' }}>Registro (inversa)</option>
                <option value="-last_login" {{ $request->get('sort') == '-last_login' ? 'selected' : '' }}>Último acceso</option>
                <option value="last_login" {{ $request->get('sort') == 'last_login' ? 'selected' : '' }}>Último acceso (inversa)</option>
            </select>
        </div>
        <div class="table-scrollable">
            <table class="table table-center table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo electrónico</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Último acceso</th>
                        <th>Acciones</th>
                    </tr>
                    <tr>
                        <th><input type="text" name="name" class="form-control" placeholder="Nombre..." value="{{ $request->get('name') }}"></th>
                        <th><input type="text" name="email" class="form-control" placeholder="Correo electrónico..." value="{{ $request->get('email') }}"></th>
                        <th>
                            <select name="type" class="form-control">
                                <option value="">-- Seleccione --</option>
                                @foreach(config('protecms.users.type') as $type)
                                    <option value="{{ $type }}" {{ $request->get('type') == $type ? 'selected' : '' }}>{{ trans('users.type.' . $type) }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th>
                            <select name="status" class="form-control">
                                <option value="">-- Seleccione --</option>
                                @foreach(config('protecms.users.status') as $status)
                                    <option value="{{ $status }}" {{ $request->get('status') == $status ? 'selected' : '' }}>{{ trans('users.status.' . $status) }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th><input type="text" name="last_login" class="form-control datetimerange" placeholder="Último acceso..." value="{{ $request->get('last_login') }}"></th>
                        <th>
                            <button type="submit" class="btn btn-block btn-primary">Filtrar</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                @if (count($users))
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ trans('users.type.' . $user->type) }}</td>
                            <td>{{ trans('users.status.' . $user->status) }}</td>
                            <td>{{ $user->last_login ? $user->last_login->diffForHumans() : '-' }}</td>
                            <td class="table-actions">
                                @if (! Auth::user()->isAdmin() && Auth::user()->hasPermission('admin.panel.users.view'))
                                    <div class="col-md-offset-3 col-md-6 col-xs-12">
                                        <a href="{{ route('admin::panel::users::show', ['id' => $user->id]) }}" class="btn btn-primary btn-block">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                @else
                                    <div class="col-md-6 col-xs-6">
                                        <a href="{{ route('admin::panel::users::edit', ['id' => $user->id]) }}" class="btn btn-primary btn-block">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <a href="{{ route('admin::panel::users::delete', ['id' => $user->id]) }}" class="btn btn-danger btn-block confirm-custom {{ $user->id == Auth::user()->id ? 'disabled' : '' }}" data-title="Acción irreversible" data-text="¿Está seguro de que desea continuar? Se eliminará el usuario permanentemente del sistema y no se podrá recuperar. <br><br>Se perderá todo lo relacionado con el usuario como por ejemplo los comentarios publicados en la web. {{ $user->isAdminOrVolunteer() ? '<br><br>(Cosas como los artículos o páginas publicados por el usuario serán asignados al usuario administrador)' : '' }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">
                            @if ($total)
                                No existen usuarios con esos parámetros.
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

    {!! $users->appends($request->all())->links() !!}
@stop

@section('page.help.text')
    <p>Esta página muestra el listado de usuarios de la protectora.</p>
    <p>Se pueden ordenar por nombre, fecha de registro, fecha de última conexión, correo electrónico y se pueden filtrar por nombre, correo electrónico, tipo, estado y último acceso.</p>

    <p>Puedes editar y eliminar un usuario haciendo clic en estos botones.</p>
    <p>
        <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
    </p>
    <p class="bg-info">No es posible eliminar su propio usuario. Si quiere eliminar su cuenta permanentemente póngase en contacto con un administrador.</p>
@stop