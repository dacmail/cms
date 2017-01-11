@extends('admin.layouts.base')

@section('page.title')
    Preguntas frecuentes
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::support::index') }}">Soporte</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
    	<a href="{{ route('admin::support::faq') }}">Preguntas frecuentes</a>
    </li>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="faq-page faq-content-1">
            <div class="faq-content-container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="faq-section ">
                            <h2 class="faq-title uppercase font-blue">General</h2>
                            <div class="panel-group accordion faq-content" id="accordion1">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1" aria-expanded="false"> ¿Por qué no veo todas las secciones del panel?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">
                                            <p>Si no ves alguna sección del panel quiere decir que tu usuario no tiene permiso para acceder a dicha sección. Habla con el administrador para revisar tus permisos.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_8" aria-expanded="false"> Cuando quiero traducir algo, sólo me aparece Español o Inglés, ¿por qué?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_8" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            <p>Ahí aparecen los idiomas que están instalados. Para instalar más idiomas, accede a la sección Panel del menú superior y luego a Protectora del menú lateral.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_7" aria-expanded="false"> Quiero traducir la ficha de un animal, un artículo o página. ¿Cómo lo hago?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_7" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            <p>Para traducir un artículo, página o ficha del animal simplemente tienes que modificar el idioma en el que se muestra. Esto es accesible en la página de edición, justo arriba de los campos a editar en cuestión.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_9" aria-expanded="false"> ¿Cómo elimino una traducción sin eliminar el idioma principal?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_9" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            <p>En la pantalla de edicción verás un desplegable, justo arriba de los campos a editar. Ahí puedes seleccionar otro idioma. Si está publicado dicho idioma, justo debajo del desplegable aparecerá un botón para eliminarla.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_2" aria-expanded="false"> He encontrado un error, ¿qué hago?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_2" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            <p>Si encuentras un error, por favor, notifícalo lo antes posible mediante la sección <a href="{{ route('admin::support::contact') }}">Soporte/Contacto</a>.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_3" aria-expanded="false"> Se nos ha ocurrido una mejora para el proyecto, ¿qué hacemos?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_3" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            <p>Si tenéis en mente alguna mejora que puede ayudar al proyecto, por favor, notifícalo mediante la sección <a href="{{ route('admin::support::contact') }}">Soporte/Contacto</a>.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_4" aria-expanded="false"> Quiero cambiar las columnas de los listados, ¿es posible?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_4" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            <p>Actualmente no es posible cambiar la estructura de los listados.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_6" aria-expanded="false"> Quiero cambiar el idioma del panel de administración, ¿es posible?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_6" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            <p>Actualmente el panel de administración solo está disponible en Español, próximamente estará disponible en más idiomas. ¿Quieres contribuir traduciéndo el proyecto? Puedes hacerlo enviando un mensaje mediante la sección <a href="{{ route('admin::support::contact') }}">Soporte/Contacto</a>.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_10" aria-expanded="false"> ¿Puedo recuperar un objeto (animal, artículo, página...) eliminado?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_10" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            <p>Sí, es posible recuperarlo. Cuando se elimina un objeto, éste permanece en el sistema 30 días. Una vez hayan concluido esos 30 días, el objeto se eliminará permanentemente del sistema.</p>
                                            <p>Para recuperar un objeto, simplemente vaya a la sección correspondiente (por ejemplo, las páginas eliminadas están en la sección Páginas eliminadas) y haga clic en el botón de recuperar.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-section ">
                            <h2 class="faq-title uppercase font-blue">Artículos y páginas</h2>
                            <div class="panel-group accordion faq-content" id="accordion3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1"> ¿Qué diferencia hay entre un artículo y una página?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_3_1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>La diferencia principal es que los artículos aparecen en el bloque central de la página principal de la página web. Pueden ser noticias, eventos y demás. Las páginas son para información estática (quienes somos, ayudanos, pasos para adoptar...)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_2"> ¿Qué quiere decir que un artículo es fijo?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_3_2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Esto quiere decir que el artículo que se haya configurado como fijo aparecerá siempre el primero en la página principal de la página web.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_3"> ¿Por qué no se modifica el campo URL editando un artículo o una página?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_3_3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Éste campo no se modifica automáticamente (al crear sí lo hace) porque con él se genera el enlace de acceso a la página o artículo. Si ya has creado un artículo y has compartido ese enlace y cambias el campo URL, dejará de estar disponible en el anterior enlace.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="faq-section ">
                            <h2 class="faq-title uppercase font-blue">Animales</h2>
                            <div class="panel-group accordion faq-content" id="accordion2">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_1" aria-expanded="false"> ¿Cómo puedo crear la ficha de un animal?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_2_1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">
                                            <p>Para crear una ficha de un animal debes al Panel (mediante el menú superior) y luego hacer clic en Crear ficha en la barra lateral.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_2" aria-expanded="false"> ¿Qué es la foto principal?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_2_2" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            <p>Es la foto que se mostrará en los listados de la página web, informes y demás.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_3" aria-expanded="false"> ¿Qué significa que un animal no es visible?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_2_3" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">
                                            <p>Esto quiere decir que no será visible en la página web para ningún usuario. No se mostrará en los listados ni se podrá acceder a su ficha. En el panel de administración no tiene ningun efecto.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion2" href="#collapse_2_4" aria-expanded="false"> ¿Puedo subir varias fotos a la vez a la ficha del animal?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_2_4" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                            <p>Sí, es posible. Se pueden subir fotos a la vez y de dos formas: Puedes arrastrar todas las fotos al recuadro de subida o hacer clic en el recuadro de subida y seleccionar una o varias.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-section ">
                            <h2 class="faq-title uppercase font-blue">Usuarios</h2>
                            <div class="panel-group accordion faq-content" id="accordion4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapse_4_1"> ¿Qué diferencia existe entre los tipos de usuario?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_4_1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Existen 3 tipos de usuario: Usuario, Voluntario y Administrador.</p>
                                            <p>Los usuarios son, como su nombre indica, usuarios de la plataforma. Éstos pueden comentar en los artículos y en un futuro podrán seguir animales para estar al tanto de los cambios, por si quieren adoptarlo.</p>
                                            <p>Los voluntarios, dependiendo de los permisos que el administrador les haya dado, pueden acceder al panel de administración, añadir fichas de animales, consultar las finanzas, etc. Todo depende de los permisos asignados.</p>
                                            <p>Los administradores tienen acceso total a la plataforma.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapse_4_2"> Si elimino un usuario, ¿se elimina permanentemente?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_4_2" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Sí. A diferencia de los artículos, páginas o animales, una vez se borre un usuario, éste desaparecerá completamente del sistema. Si era voluntario o administrador, todo lo publicado/creado por este usuario se asignará a un administrador de la protectora.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapse_4_3"> ¿Qué significa que un usuario está bloqueado?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_4_3" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Un usuario bloqueado no podrá acceder al sistema ni modificar su información.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="faq-section ">
                            <h2 class="faq-title uppercase font-blue">Archivos</h2>
                            <div class="panel-group accordion faq-content" id="accordion4">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <i class="fa fa-circle"></i>
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion4" href="#collapse_5_1"> ¿Qué diferencia hay entre un archivo público y otro que no?</a>
                                        </h4>
                                    </div>
                                    <div id="collapse_5_1" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Los archivos públicos están disponible para todos los usuarios, registrados o no. Estos archivos pueden ser contratos de adopción para descargar, alta de socio, etc.</p>
                                            <p>Los archivos no públicos son archivos que solo son accesibles por voluntarios y administradores de la protectora.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
