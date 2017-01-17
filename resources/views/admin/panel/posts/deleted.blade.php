@extends('admin.layouts.base')

@section('page.title')
    Listado de artículos eliminados
    <small><br>(Los artículos se eliminarán de forma permanente 30 días después de su eliminación)</small>
    <div class="pull-right"><small>Mostrando {{ $posts->count() }} artículos de un total de {{ $total }}.</small></div>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::posts::index') }}">Artículos</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::posts::deleted') }}">Eliminados</a>
    </li>
@stop

@section('content')
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
                                <a href="{{ route('admin::panel::posts::restore', ['id' => $post->id]) }}" class="btn btn-primary btn-block confirm">
                                    <i class="fa fa-history"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">
                            @if ($total)
                                No existen artículos con esos parámetros.
                            @else
                                <p class="bg-info text-center">No existen artículos eliminados.</p>
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
    <p>Esta página muestra el listado de artículos eliminados de la protectora.</p>
    <p>Se pueden ordenar por fecha de publicación y se pueden filtrar por título, fecha de publicación, estado y categoría.</p>
    <p>Haciendo clic en el siguiente botón se recuperará el artículo y aparecerá en el listado de artículos.</p>
    <p><button class="btn btn-primary"><i class="fa fa-history"></i></button></p>
    <p class="bg-info">Los artículos que permanezcan más de 30 días eliminados, se eliminarán de forma permanente.</p>
@stop