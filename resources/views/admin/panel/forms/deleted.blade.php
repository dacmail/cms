@extends('admin.layouts.base')

@section('page.title')
    Listado de formularios eliminados
    <small><br>(Los formularios se eliminarán de forma permanente 30 días después de su eliminación)</small>
    <div class="pull-right"><small>Mostrando {{ $forms->count() }} formularios de un total de {{ $total }}.</small></div>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::forms::index') }}">Formularios</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::forms::deleted') }}">Eliminados</a>
    </li>
@stop

@section('content')
    <form action="" method="GET">
        <div class="pull-right">
            Ordenar por <select name="sort" class="margin-bottom-20" onchange="this.form.submit()">
                <option value="-created_at" {{ $request->get('sort') == '-created_at' ? 'selected' : '' }}>Fecha de creación</option>
                <option value="email" {{ $request->get('sort') == 'email' ? 'selected' : '' }}>Email</option>
                <option value="-status" {{ $request->get('sort') == '-status' ? 'selected' : '' }}>Estado</option>

            </select>
        </div>
        <div class="table-scrollable">
            <table class="table table-center table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Email</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                <tr>
                    <th><input type="text" name="translations.title" class="form-control" placeholder="Título..." value="{{ $request->get('translations_title') }}"></th>
                    <th><input type="text" name="email" class="form-control" placeholder="Email..." value="{{ $request->get('email') }}"></th>
                    <th>
                        <select name="status" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach(config('protecms.forms.status') as $status)
                                <option value="{{ $status }}" {{ $request->get('status') == $status ? 'selected' : '' }}>{{ trans('forms.status.' . $status) }}</option>
                            @endforeach
                        </select>
                    </th>
                    <th>
                        <button type="submit" class="btn btn-block btn-primary">Filtrar</button>
                    </th>
                </tr>
                </thead>
                <tbody>
                @if (count($forms))
                    @foreach ($forms as $form)
                        <tr>
                            <td class="text-left">{{ str_limit($form->title, 40, '...') }}</td>
                            <td>{{ $form->email }}</td>
                            <td>{{ trans('forms.status.' . $form->status) }}</td>
                            <td class="table-actions">
                                <a href="{{ route('admin::panel::forms::restore', ['id' => $form->id]) }}" class="btn btn-primary btn-block confirm">
                                    <i class="fa fa-history"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">
                            @if ($total)
                                No existen formularios eliminados con esos parámetros.
                            @else
                                <p class="bg-info text-center">Aún no se ha creado ningún formulario.</p>
                            @endif
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </form>

    {!! $forms->appends($request->all())->links() !!}
@stop

@section('page.help.text')
    <p>Esta página muestra el listado de formularios eliminados de la protectora.</p>
    <p>Se pueden ordenar por fecha de creación, email o estado y se pueden filtrar por título, email y estado.</p>
    <p>Haciendo clic en el siguiente botón se recuperará el formulario y aparecerá en el listado de formularios.</p>
    <p><button class="btn btn-primary"><i class="fa fa-history"></i></button></p>
    <p class="bg-info">Los formularios que permanezcan más de 30 días eliminados, se eliminarán de forma permanente.</p>
@stop
