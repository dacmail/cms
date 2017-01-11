@extends('admin.layouts.base')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue bold uppercase">Últimos animales</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-center table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Especie</th>
                            <th>Género</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($animals as $animal)
                                <tr>
                                    <td>{{ $animal->name }}</td>
                                    <td>{{ trans_choice('animals.status.' . $animal->status, 1) }}</td>
                                    <td>{{ trans_choice('animals.kind.' . $animal->kind, 1) }}</td>
                                    <td>{{ trans_choice('animals.gender.' . $animal->gender, 1) }}</td>
                                    <td class="table-actions-single">
                                        <a href="{{ route('admin::panel::animals::edit', ['id' => $animal->id]) }}" class="btn btn-primary btn-block"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue bold uppercase">¡Bienvenidos a la nueva versión!</span>
                </div>
            </div>
            <div class="portlet-body">
                <p>Os doy la bienvenida a la nueva versión de proyecto: ProteCMS v2 (beta). Todavía quedan funcionalidades por activar y algunas cosas que corregir, pero esta es la nueva versión.</p>
                <p>Es una reescritura completa del proyecto, no una simple actualización, de ahí que su desarrollo se haya extendido varios meses. Ahora será mucho más fácil y rápido añadir nuevas funcionalidades y corregir los errores que puedan surgir.</p>
                <p>La nueva versión consta también de un diseño totalmente renovado de la página web, donde el contenido toma más importancia y donde los elementos de la misma son más personalizables (como los bloques, el fondo de la web, logo y cabecera...). Con el tiempo se irán añadiendo más temas para que cada protectora pueda elegir el que más le guste.</p>
                <p>Si tienes cualquier duda, se te ha ocurrido alguna mejora o funcionalidad o tienes algun error, por favor, no dudes en ponerte en <a href="{{ route('admin::support::contact') }}">contacto</a>, por mínimo que sea.</p>
                <p>Espero que el proyecto os guste y os sea realmente de utilidad. No olvidéis en compartir el proyecto con otras protectoras y en seguir al proyecto en las redes sociales. ¡Gracias por salvar vidas!</p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue bold uppercase">Últimos artículos</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-center table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td class="text-left">{{ str_limit($post->title, 80, '...') }}</td>
                                    <td>{{ $post->category->title }}</td>
                                    <td class="table-actions-single">
                                        <a href="{{ route('admin::panel::posts::edit', ['id' => $post->id]) }}" class="btn btn-primary btn-block"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue bold uppercase">Últimos usuarios</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-center table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo electrónico</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="table-actions-single">
                                    <a href="{{ route('admin::panel::users::edit', ['id' => $user->id]) }}" class="btn btn-primary btn-block"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop