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
    <div class="row">
        <div class="col-md-6">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <span class="caption-subject font-blue bold uppercase">Sugerencias pendientes</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <p class="bg-info text-center">
                        Aún no se han recibido sugerencias. <br>Si tienes en mente algo que pueda ayudar al proyecto, por favor, <a href="{{ route('admin::support::contact') }}">envíala</a> para que el proyecto mejore.
                    </p>
                    {{-- <div class="mt-element-list">
                        <div class="mt-list-container list-news">
                            <ul>
                                <li class="mt-list-item">
                                    <div class="list-item-content">
                                        <h3 class="uppercase">
                                            <a href="javascript:;">Latest news on Metronic</a>
                                        </h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec elementum gravida mauris, a tincidunt dolor porttitor eu. </p>
                                    </div>
                                </li>
                                <li class="mt-list-item">
                                    <div class="list-item-content">
                                        <h3 class="uppercase">
                                            <a href="javascript:;">Latest news on Metronic</a>
                                        </h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec elementum gravida mauris, a tincidunt dolor porttitor eu. </p>
                                    </div>
                                </li>
                                <li class="mt-list-item">
                                    <div class="list-item-content">
                                        <h3 class="uppercase">
                                            <a href="javascript:;">Latest news on Metronic</a>
                                        </h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec elementum gravida mauris, a tincidunt dolor porttitor eu. </p>
                                    </div>
                                </li>
                                <li class="mt-list-item">
                                    <div class="list-item-content">
                                        <h3 class="uppercase">
                                            <a href="javascript:;">Latest news on Metronic</a>
                                        </h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec elementum gravida mauris, a tincidunt dolor porttitor eu. </p>
                                    </div>
                                </li>
                                <li class="mt-list-item">
                                    <div class="list-item-content">
                                        <h3 class="uppercase">
                                            <a href="javascript:;">Latest news on Metronic</a>
                                        </h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec elementum gravida mauris, a tincidunt dolor porttitor eu. </p>
                                    </div>
                                </li>
                                <li class="mt-list-item">
                                    <div class="list-item-content">
                                        <h3 class="uppercase">
                                            <a href="javascript:;">Latest news on Metronic</a>
                                        </h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec elementum gravida mauris, a tincidunt dolor porttitor eu. </p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
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
    </div>
@stop