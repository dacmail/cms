@extends('admin.layouts.base')

@section('page.title')
    Listado de artículos <div class="pull-right"><small>Mostrando {{ $posts->count() }} artículos de un total de {{ $total }}.</small></div>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::posts::index') }}">Artículos</a>
    </li>
@stop

@section('content')
    <a href="{{route('admin::panel::posts::create')}}" class="btn btn-primary visible-xs-inline-block visible-sm-inline-block">Crear articulo</a>
    <form action="" method="GET">
        <div class="pull-right">
            Ordenar por <select name="sort" class="margin-bottom-20" onchange="this.form.submit()">
                <option value="-published_at" {{ $request->get('sort') == '-published_at' ? 'selected' : '' }}>Fecha de publicación</option>
                
            </select>
        </div>
        <div class="table-scrollable">
            <table class="table table-center table-striped table-bordered table-condensed table-hover">
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Publicación</th>
                    <th>Estado</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
                <tr>
                    <th><input type="text" name="translations.title" class="form-control" placeholder="Título..." value="{{ $request->get('translations_title') }}"></th>
                    <th><input type="text" name="published_at" class="form-control datetimerange" placeholder="Fecha de publicación..." value="{{ $request->get('published_at') }}"></th>
                    <th>
                        <select name="status" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach(config('protecms.posts.status') as $status)
                                <option value="{{ $status }}" {{ $request->get('status') == $status ? 'selected' : '' }}>{{ trans('posts.status.' . $status) }}</option>
                            @endforeach
                        </select>
                    </th>
                    <th>
                        <select name="category_id" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach($web->posts_categories as $category)
                                <option value="{{ $category->id }}" {{ $request->get('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </th>
                    <th class="table-actions">
                        <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-search"></i></button>
                    </th>
                </tr>
                </thead>
                <tbody>
                @if (count($posts))
                    @foreach ($posts as $post)
                        <tr>
                            <td class="text-left">{{ str_limit($post->title, 70, '...') }}</td>
                            <td>
                                <span data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ $post->published_at->format('d-m-Y H:i') }}">
                                    {{ $post->published_at->diffForHumans() }}
                                </span>
                            </td>
                            <td>{{ trans('posts.status.' . $post->status) }}</td>
                            <td>{{ $post->category->title }}</td>
                            <td class="table-actions">
                                @if (! Auth::user()->isAdmin() && Auth::user()->hasPermission('admin.panel.posts.view') || Auth::user()->hasPermission('admin.panel.posts.crud') && Auth::user()->id !== $post->user_id)
                                    <div class="col-md-offset-3 col-md-6 col-xs-12">
                                        <a href="{{ route('admin::panel::posts::show', ['id' => $post->id]) }}" class="btn btn-primary btn-block">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                @else
                                    <div class="col-md-6 col-xs-6">
                                        <a href="{{ route('admin::panel::posts::edit', ['id' => $post->id]) }}" class="btn btn-primary btn-block">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <a href="{{ route('admin::panel::posts::delete', ['id' => $post->id]) }}" class="btn btn-danger btn-block confirm">
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
                                No existen artículos con esos parámetros.
                            @else
                                <div class="bg-info text-center">
                                    <p>Aún no se ha creado ningún artículo.</p>
                                    <div class="col-md-offset-4 col-md-4"><a href="{{ route('admin::panel::posts::create') }}" class="btn btn-default btn-block" >Crear artículo</a></div>
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

    {!! $posts->appends($request->all())->links() !!}
@stop

@section('page.help.text')
    <p>Esta página muestra el listado de artículos de la protectora.</p>
    <p>Se pueden ordenar por fecha de publicación y se pueden filtrar por título, fecha de publicación, estado y categoría.</p>

    <h4>Permisos</h4>
    <p>En esta página existen dos tipos de permisos: El voluntario puede editar y eliminar un artículo o solo puede verlo.</p>
    <p>Si ve estos botones es que tiene acceso a editar y eliminar el artículo.</p>
    <p>
        <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
    </p>
    <p>Sin embargo si solo ve este botón, es que solo tiene permisos para ver el artículo y no para actualizarlo o eliminarlo.</p>
    <p><button class="btn btn-primary"><i class="fa fa-eye"></i></button></p>
@stop
