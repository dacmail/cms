<!-- BEGIN MEGA MENU -->
<div class="hor-menu hor-menu-light hidden-xs hidden-sm">
    <ul class="nav navbar-nav">
        <li class="mega-menu-dropdown {{ Request::is('admin/panel*') ? 'active' : '' }}">
            <a href="{{ route('admin::panel::index') }}" class="dropdown-toggle"> Panel</a>
        </li>
        <li class="mega-menu-dropdown {{ Request::is('admin/design*') ? 'active' : '' }} {{ ! Auth::user()->hasPermissions(['admin.design', 'admin.design.view']) ? 'hide' : '' }}">
            <a href="{{ route('admin::design::index') }}" class="dropdown-toggle"> Página web</a>
        </li>
        <li class="mega-menu-dropdown {{ Request::is('admin/calendar*') ? 'active' : '' }} {{ ! Auth::user()->hasPermissions(['admin.calendar', 'admin.calendar.view']) ? 'hide' : '' }}">
            <a href="{{ route('admin::calendar::index') }}?type=all" class="dropdown-toggle"> Calendario</a>
        </li>
        <li class="mega-menu-dropdown {{ Request::is('admin/finances*') ? 'active' : '' }} {{ ! Auth::user()->hasPermissions(['admin.finances', 'admin.finances.view']) ? 'hide' : '' }}">
            <a href="{{ route('admin::finances::index') }}" class="dropdown-toggle"> Finanzas</a>
        </li>
        <li class="mega-menu-dropdown hide {{ Request::is('admin/reports*') ? 'active' : '' }} {{ ! Auth::user()->hasPermissions(['admin.reports']) ? 'hide' : '' }}">
            <a href="javascript:;" class="dropdown-toggle"> Informes</a>
        </li>
        <li class="mega-menu-dropdown {{ Request::is('admin/support*') ? 'active' : '' }} {{ ! Auth::user()->hasPermissions(['admin.support']) ? 'hide' : '' }}">
            <a href="{{ route('admin::support::index') }}" class="dropdown-toggle"> Soporte</a>
        </li>
        @if (app('App\Models\Webs\Web')->subdomain === 'admin')
            <li class="mega-menu-dropdown {{ Request::is('superadmin*') ? 'active' : '' }}">
                <a href="{{ route('superadmin::index') }}" class="dropdown-toggle"> SuperAdmin</a>
            </li>
        @endif
    </ul>
</div>
<!-- END MEGA MENU -->