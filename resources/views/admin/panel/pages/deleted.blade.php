@extends('admin.layouts.base')

@section('page.title')
    Listado de páginas eliminadas
    <small><br>(Las páginas se eliminarán de forma permanente 30 días después de su eliminación)</small>
    <div class="pull-right"><small>Mostrando {{ $pages->count() }} páginas de un total de {{ $total }}.</small></div>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::pages::index') }}">Páginas</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::pages::deleted') }}">Eliminadas</a>
    </li>
@stop

@section('content')
    <div class="pull-right">
        Ordenar por <select name="sort" class="margin-bottom-20" onchange="this.form.submit()">
            <option value="-published_at" {{ $request->get('sort') == '-published_at' ? 'selected' : '' }}>Fecha de publicación</option>
            
        </select>
    </div>
    <div class="table-scrollable">
        <form action="" method="GET">
            <table class="table table-center table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Publicación</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                <tr>
                    <th><input type="text" name="translations.title" class="form-control" placeholder="Título..." value="{{ $request->get('translations_title') }}"></th>
                    <th><input type="text" name="published_at" class="form-control datetimerange" placeholder="Fecha de publicación..." value="{{ $request->get('published_at') }}"></th>
                    <th>
                        <select name="status" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach(config('protecms.pages.status') as $status)
                                <option value="{{ $status }}" {{ $request->get('status') == $status ? 'selected' : '' }}>{{ trans('pages.status.' . $status) }}</option>
                            @endforeach
                        </select>
                    </th>
                    <th>
                        <button type="submit" class="btn btn-block btn-primary">Filtrar</button>
                    </th>
                </tr>
                </thead>
                <tbody>
                @if (count($pages))
                    @foreach ($pages as $page)
                        <tr>
                            <td class="text-left">{{ str_limit($page->title, 70, '...') }}</td>
                            <td>
                                <span data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ $page->published_at->format('d-m-Y H:i') }}">
                                    {{ $page->published_at->diffForHumans() }}
                                </span>
                            </td>
                            <td>{{ trans('pages.status.' . $page->status) }}</td>
                            <td class="table-actions">
                                <a href="{{ route('admin::panel::pages::restore', ['id' => $page->id]) }}" class="btn btn-primary btn-block confirm" title="Recuperar"><i class="fa fa-history"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">
                            @if ($total)
                                No existen páginas con esos parámetros.
                            @else
                                <p class="bg-info text-center">No existen páginas eliminadas.</p>
                            @endif
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </form>
    </div>

    {!! $pages->appends($request->all())->links() !!}
@stop