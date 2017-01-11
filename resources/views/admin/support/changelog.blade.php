@extends('admin.layouts.base')

@section('page.title')
    Historial de cambios
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::support::index') }}">Soporte</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
    	<a href="{{ route('admin::support::changelog') }}">Historial de cambios</a>
    </li>
@stop

@section('content')
<div class="row changelog">
    <div class="col-md-12">
        <h4 class="margin-top-40">11-01-2017</h4>
        <ul>
            <li><span class="label label-info">novedad</span> Modificado el asunto en el formulario de contacto de un animal cuando está perdido o ha sido encontrado.</li>
            <li><span class="label label-warning">corrección</span> Ahora es posible fijar uno o varios artículos en la página principal.</li>
        </ul>
        <h4 class="margin-top-40">04-01-2017</h4>
        <ul>
            <li><span class="label label-info">novedad</span> Añadido el tipo Enfermedad a la salud de los animales.</li>
            <li><span class="label label-info">novedad</span> Ahora al crear un registro de salud de un animal se puede añadir el gasto automáticamente a las finanzas.</li>
        </ul>
        <h4 class="margin-top-40">03-01-2017</h4>
        <ul>
            <li><span class="label label-info">novedad</span> Ahora los formularios tienen un captcha de seguridad para evitar el SPAM.</li>
            <li><span class="label label-info">novedad</span> Integración de la salud de los animales con el calendario. Ahora cuando se añadan tratamientos, operaciones, revisiones, etc, aparecerán en el calendario de la protectora.</li>
            <li><span class="label label-warning">corrección</span> Ahora al insertar un vídeo (por ejemplo de Youtube), el vídeo se adapta al tamaño del dispositivo.</li>
        </ul>
        <h4 class="margin-top-40">22-12-2016</h4>
        <ul>
            <li><span class="label label-info">novedad</span> Añadido el tipo Prueba y el campo Resultado en la salud de los animales.</li>
            <li><span class="label label-warning">corrección</span> Corregido un error que provocaba que al seleccionar un bloque como inactivo apareciese en la web.</li>
        </ul>
        <h4 class="margin-top-40">20-12-2016</h4>
        <ul>
            <li><span class="label label-info">novedad</span> Añadido el sistema de permisos. Ahora un administrador podrá asignar permisos personalizados a los voluntarios.</li>
            <li><span class="label label-warning">corrección</span> Correcciones menores.</li>
        </ul>
        <h4 class="margin-top-40">17-12-2016</h4>
        <ul>
            <li><span class="label label-info">novedad</span> Ahora se puede añadir CSS personalizado desde la sección <a href="{{ route('admin::design::css') }}">Diseño</a>.</li>
            <li><span class="label label-info">novedad</span> A partir de ahora para ver la listas de tareas pendientes, en proceso, realizadas y errores conocidos se hará a través de <a href="https://trello.com/b/j4eAFtN1/protecms" target="_blank">Trello</a>.</li>
            <li><span class="label label-warning">corrección</span> Ahora cuando una protectora tenga un dominio asignado el subdominio redirigirá automáticamente a éste.</li>
            <li><span class="label label-warning">corrección</span> Los bloques de la página web ahora tienen un correcto espaciado tanto superior como inferior.</li>
        </ul>
        <h4 class="margin-top-40">14-12-2016</h4>
        <ul>
            <li><span class="label label-info">novedad</span> Añadida la alerta de política de cookies obligatoria por la <a href="https://www.agpd.es/portalwebAGPD/canaldocumentacion/cookies/index-ides-idphp.php">ley europea de cookies</a>.</li>
        </ul>
        <h4 class="margin-top-40">09-12-2016</h4>
        <ul>
            <li><span class="label label-warning">corrección</span> Corregido problema que impedía la creación de bloques.</li>
        </ul>
        <h4 class="margin-top-40">04-12-2016</h4>
        <ul>
            <li><span class="label label-info">novedad</span> Ahora se puede modificar el tamaño, color y tipo de fuente en los textos.</li>
            <li><span class="label label-warning">corrección</span> Corregido problema que provocaba que no se cambiase el logo o cabecera correctamente.</li>
        </ul>
        <h4 class="margin-top-40">25-11-2016</h4>
        <ul>
            <li><span class="label label-info">novedad</span> Añadida la gestión de apadrinamientos de los animales.</li>
        </ul>
        <h4 class="margin-top-40">21-11-2016</h4>
        <ul>
            <li><span class="label label-info">novedad</span> Ahora se puede exportar a PDF la ficha de un animal.</li>
            <li><span class="label label-warning">correción</span> Corregidos errores menores.</li>
        </ul>
        <h4 class="margin-top-40">18-11-2016</h4>
        <ul>
            <li><span class="label label-info">novedad</span> Añadida la gestión de salud de los animales.</li>
            <li><span class="label label-info">novedad</span> Añadida la gestión de casas de acogida.</li>
        </ul>
        <h4 class="margin-top-40">17-11-2016</h4>
        <ul>
            <li><span class="label label-info">novedad</span> Añadidas a la página de <a href="{{ route('admin::panel::stats') }}">estadísticas</a> las visitas y visualizaciones del último mes.</li>
            <li><span class="label label-warning">corrección</span> Corregido un error que no permitia subir fotos a las fichas de los animales superiores a 1mb. </li>
            <li><span class="label label-warning">corrección</span> Ahora es posible acceder al panel de administración mediante la url /administracion. </li>
            <li><span class="label label-warning">corrección</span> Ahora aparece el enlace "Acceder al Panel de administración" al pié de la página web. </li>
        </ul>
        <h4 class="margin-top-40">16-11-2016</h4>
        <ul>
            <li><span class="label label-info">novedad</span> Lanzamiento de la versión 2.0 (beta) del proyecto. </li>
        </ul>
    </div>
</div>
@stop
