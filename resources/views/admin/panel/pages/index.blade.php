@extends('admin.layouts.base')

@section('page.title')
    Listado de páginas <div class="pull-right"><small>Mostrando {{ $pages->count() }} páginas de un total de {{ $total }}.</small></div>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::pages::index') }}">Páginas</a>
    </li>
@stop

@section('content')
		    <a href="{{route('admin::panel::pages::create')}}" class="btn btn-primary visible-xs-inline-block">Crear página</a>
    <form action="" method="GET">
        <div class="pull-right">
            Ordenar por <select name="sort" class="margin-bottom-20" onchange="this.form.submit()">
                <option value="-published_at" {{ $request->get('sort') == '-published_at' ? 'selected' : '' }}>Fecha de publicación</option>
                
            </select>
        </div>
        <div class="table-scrollable">
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
                                @if (! Auth::user()->isAdmin() && Auth::user()->hasPermission('admin.panel.pages.view') || Auth::user()->hasPermission('admin.panel.pages.crud') && Auth::user()->id !== $page->user_id)
                                    <div class="col-md-offset-3 col-md-6 col-xs-12">
                                        <a href="{{ route('admin::panel::pages::show', ['id' => $page->id]) }}" class="btn btn-primary btn-block">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                @else
                                    <div class="col-md-6 col-xs-6">
                                        <a href="{{ route('admin::panel::pages::edit', ['id' => $page->id]) }}" class="btn btn-primary btn-block">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <a href="{{ route('admin::panel::pages::delete', ['id' => $page->id]) }}" class="btn btn-danger btn-block confirm">
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
                                No existen páginas con esos parámetros.
							@else
                                <div class="bg-info text-center">
                                    <p>Aún no se ha creado ninguna página.</p>
                                    <div class="col-md-offset-5 col-md-2"><a href="{{ route('admin::panel::pages::create') }}" class="btn btn-default btn-block" >Crear página</a></div>
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

    {!! $pages->appends($request->all())->links() !!}
@stop

@section('page.help.text')
    <p>Esta página muestra el listado de páginas de la protectora.</p>
    <p>Se pueden ordenar por fecha de publicación y se pueden filtrar por título, fecha de publicación y estado.</p>

    <h4>Permisos</h4>
    <p>En esta página existen dos tipos de permisos: El voluntario puede editar y eliminar una página o solo puede verla.</p>
    <p>Si ve estos botones es que tiene acceso a editar y eliminar la página.</p>
    <p>
        <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
    </p>
    <p>Sin embargo si solo ve este botón, es que solo tiene permisos para ver la página y no para actualizarla o eliminarla.</p>
    <p><button class="btn btn-primary"><i class="fa fa-eye"></i></button></p>
@stop
