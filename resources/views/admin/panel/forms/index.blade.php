@extends('admin.layouts.base')

@section('page.title')
    Listado de formularios <div class="pull-right"><small>Mostrando {{ $forms->count() }} formularios de un total de {{ $total }}.</small></div>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::forms::index') }}">Formularios</a>
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
                                <div class="col-md-6 col-xs-6">
                                    <a href="{{ route('admin::panel::forms::edit', ['id' => $form->id]) }}" class="btn btn-primary btn-block">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <a href="{{ route('admin::panel::forms::delete', ['id' => $form->id]) }}" class="btn btn-danger btn-block confirm">
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
                                No existen formularios con esos parámetros.
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
