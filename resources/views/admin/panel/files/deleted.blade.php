@extends('admin.layouts.base')

@section('page.title')
    Listado de archivos eliminados
    <small><br>(Los archivos se eliminarán de forma permanente 30 días después de su eliminación)</small>
    <div class="pull-right"><small>Mostrando {{ $files->count() }} archivos de un total de {{ $total }}.</small></div>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::files::index') }}">Archivos</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::files::create') }}">Eliminados</a>
    </li>
@stop

@section('content')
    <form action="" method="GET">
        <div class="pull-right">
            Ordenar por <select name="sort" class="margin-bottom-20" onchange="this.form.submit()">
                <option value="-created_at" {{ $request->get('sort') == '-created_at' ? 'selected' : '' }}>Fecha de publicación</option>
                
            </select>
        </div>
        <div class="table-scrollable">
            <table class="table table-center table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Archivo</th>
                    <th>Acciones</th>
                </tr>
                <tr>
                    <th><input type="text" name="title" class="form-control" placeholder="Título..." value="{{ $request->get('title') }}"></th>
                    <th><input type="text" name="description" class="form-control" placeholder="Descripción..." value="{{ $request->get('description') }}"></th>
                    <th>
                        <input type="text" class="form-control" disabled>
                    </th>
                    <th>
                        <button type="submit" class="btn btn-block btn-primary">Filtrar</button>
                    </th>
                </tr>
                </thead>
                <tbody>
                @if (count($files))
                    @foreach ($files as $file)
                        <tr>
                            <td>{{ str_limit($file->title, 40, '...') }}</td>
                            <td>{{ $file->description ? strip_tags(str_limit($file->description, 40, '...')) : '-' }}</td>
                            <td><a href="{{ route('web::upload', ['file' => $file->file]) }}" class="btn btn-default" target="_blank">Ver archivo</a></td>
                            <td class="table-actions">
                                <a href="{{ route('admin::panel::files::restore', ['id' => $file->id]) }}" class="btn btn-primary btn-block confirm">
                                    <i class="fa fa-history"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">
                            @if ($total)
                                No existen archivos con esos parámetros.
                            @else
                                <p class="bg-info text-center">Aún no se ha eliminado ningún archivo.</p>
                            @endif
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </form>

    {!! $files->appends($request->all())->links() !!}
@stop

@section('page.help.text')
    <p>Esta página muestra el listado de archivos eliminados de la protectora.</p>
    <p>Se pueden ordenar por fecha de publicación y se pueden filtrar por título y descripción.</p>
    <p>Haciendo clic en el siguiente botón se recuperará el archivo y aparecerá en el listado de archivos.</p>
    <p><button class="btn btn-primary"><i class="fa fa-history"></i></button></p>
    <p class="bg-info">Los archivos que permanezcan más de 30 días eliminados, se eliminarán de forma permanente.</p>
@stop