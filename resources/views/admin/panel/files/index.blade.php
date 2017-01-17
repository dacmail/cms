@extends('admin.layouts.base')

@section('page.title')
    Listado de archivos <div class="pull-right"><small>Mostrando {{ $files->count() }} archivos de un total de {{ $total }}.</small></div>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::files::index') }}">Archivos</a>
    </li>
@stop

@section('content')
    <a href="{{route('admin::panel::files::create')}}" class="btn btn-primary visible-xs-inline-block visible-sm-inline-block">Subir archivo</a>
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
                                <div class="col-md-6 col-xs-6">
                                    <a href="{{ route('admin::panel::files::edit', ['id' => $file->id]) }}" class="btn btn-primary btn-block">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <a href="{{ route('admin::panel::files::delete', ['id' => $file->id]) }}" class="btn btn-danger btn-block confirm">
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
                                No existen archivos con esos parámetros.
                            @else
                                <div class="bg-info text-center">
                                    <p>Aún no se ha subido ningún archivo.</p>
                                    <div class="col-md-offset-4 col-md-4"><a href="{{ route('admin::panel::files::create') }}" class="btn btn-default btn-block" >Subir archivo</a></div>
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

    {!! $files->appends($request->all())->links() !!}
@stop

@section('page.help.text')
    <p>Esta página muestra el listado de archivos de la protectora.</p>
    <p>Se pueden ordenar por fecha de publicación y se pueden filtrar por título y descripción.</p>

    <h4>Permisos</h4>
    <p>En esta página existen dos tipos de permisos: El voluntario puede editar y eliminar un archivo o solo puede verlo.</p>
    <p>Si ve estos botones es que tiene acceso a editar y eliminar el archivo.</p>
    <p>
        <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
    </p>
    <p>Sin embargo si solo ve este botón, es que solo tiene permisos para ver el archivo y no para actualizarlo o eliminarlo.</p>
    <p><button class="btn btn-primary"><i class="fa fa-eye"></i></button></p>
@stop