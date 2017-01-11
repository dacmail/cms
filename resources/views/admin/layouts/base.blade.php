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
    
    @include('admin.layouts.footer')
</body>