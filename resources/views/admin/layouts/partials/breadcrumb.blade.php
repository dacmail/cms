<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{ route('admin::panel::index') }}">Inicio</a>
            <i class="fa fa-circle"></i>
        </li>
        @yield('breadcrumb')
    </ul>

    @section('page.help')
        <button class="btn btn-default pull-right btn-help btn-primary" data-toggle="modal" data-target="#help"><i class="fa fa-question-circle"></i> Ayuda</button>
    @show
</div>
<!-- END PAGE BAR -->