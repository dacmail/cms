@include('admin.layouts.header')
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        
        @include('admin.layouts.partials.sidebar')

        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                
                @include('admin.layouts.partials.breadcrumb')

                <!-- BEGIN PAGE TITLE-->
                <h2 class="page-title"> 
                    @section('page.title')
                        Escritorio
                        <small>estadísticas, resumen y más</small>
                    @show
                </h2>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
            
                @yield('content')

            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->

    <div id="help" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ayuda</h4>
                </div>
                <div class="modal-body">
                    @section('page.help.text')
                        El texto de ayuda de esta sección está pendiente de implementar.
                    @show
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    @include('admin.layouts.footer')
</body>