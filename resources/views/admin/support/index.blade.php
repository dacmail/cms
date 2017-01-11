@extends('admin.layouts.base')

@section('page.title')
    Soporte <small>Ayuda, sugerencias y reporte de errores</small>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::support::index') }}">Soporte</a>
    </li>
@stop

@section('content')

<div class="alert alert-info text-center">
    <p>Para ver las tareas que están pendientes, en proceso, completadas o los errores conocidos haz clic en el siguiente botón:</p>
    <a href="https://trello.com/b/j4eAFtN1/protecms" target="_blank" class="btn btn-default margin-top-30">Ir al panel de Trello</a>
</div>

<!-- <div class="row">
	<div class="col-md-6">
	    <div class="portlet light portlet-fit bordered">
	        <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue bold uppercase">Sugerencias pendientes</span>
                </div>
            </div>
	        <div class="portlet-body">
				<p>Las sugerencias que aparecen aquí son sugerencias que han mandado otras protectoras o son </p>
	        	<p class="bg-info text-center hide">
	            	Aún no se han recibido sugerencias. <br>Si tienes en mente algo que pueda ayudar al proyecto, por favor, <a href="{{ route('admin::support::contact') }}">envíala</a> para que el proyecto mejore.
	            </p>
	            <div class="mt-element-list">
	                <div class="mt-list-container list-news">
	                    <ul>
							<li class="mt-list-item">
								<div class="list-item-content">
									<h3 class="uppercase">
										Gestión de notas de animales
									</h3>
								</div>
							</li>
							<li class="mt-list-item">
								<div class="list-item-content">
									<h3 class="uppercase">
										Gestión de tareas para voluntarios
									</h3>
								</div>
							</li>
							<li class="mt-list-item">
								<div class="list-item-content">
									<h3 class="uppercase">
										Generación de informes
									</h3>
									<p>Generación de informes de todo tipo: animales adoptados, finanzas, etc...</p>
								</div>
							</li>
							<li class="mt-list-item">
								<div class="list-item-content">
									<h3 class="uppercase">
										Controlar visitas de usuarios
									</h3>
									<p>Esto se refiere a saber cuántos usuarios entraron en la página de la protectora y que se pueda filtrar por días, meses y años.</p>
								</div>
							</li>
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="col-md-6">
	    <div class="portlet light portlet-fit bordered">
	        <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue bold uppercase">Errores conocidos</span>
                </div>
            </div>
	        <div class="portlet-body">
	            <p class="bg-info text-center">
	            	No existen errores conocidos. <br>Si encuentras uno, por favor, <a href="{{ route('admin::support::contact') }}">notifícalo cuanto antes.</a>
	            </p>
	        </div>
	    </div>
	</div>
</div> -->
@stop
