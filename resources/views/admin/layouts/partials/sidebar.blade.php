<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu page-header-fixed hidden-sm hidden-xs" data-keep-expanded="false" data-auto-scroll="false" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            @if (app('App\Models\Webs\Web')->subdomain === 'admin')
            <li class="nav-item">
                <form action="{{ route('superadmin::set_web') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <select name="web_id" class="form-control" onchange="this.form.submit()">
                            <option value="">Todas las protectoras</option>
                            @foreach (App\Models\Webs\Web::all() as $web_filter)
                                <option value="{{ $web_filter->id }}" {{ app('App\Models\Webs\Web')->getConfig('web') == $web_filter->id ? 'selected' :  ''}}>{{ $web_filter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </li>
            @endif

            @foreach ($sidebar as $key => $section)

                @if (isset($section['permissions']) && ! Auth::user()->hasPermissions($section['permissions']))
                    @continue
                @endif

                    <li class="nav-item @if (is_array($section['menu']['base'])) @foreach ($section['menu']['base'] as $base) {{ Request::is($base) ? 'open' : '' }} @endforeach @else {{ Request::is($section['menu']['base']) ? 'open' : '' }} @endif {{ $key == 0 ? 'start' : '' }}">

                    @if (isset($section['menu']['permissions']) && ! Auth::user()->hasPermissions($section['menu']['permissions']))
                        @continue
                    @endif

                    <a href="{{ $section['menu']['url'] }}" class="nav-link nav-toggle">
                        <i class="{{ $section['menu']['icon'] }}"></i>
                        <span class="title">{{ $section['menu']['title'] }}</span>
                        @if (isset($section['menu']['submenu']))
                            <span class="arrow @if (is_array($section['menu']['base'])) @foreach ($section['menu']['base'] as $base) {{ Request::is($base) ? 'open' : '' }} @endforeach @else {{ Request::is($section['menu']['base']) ? 'open' : '' }} @endif"></span>
                        @endif
                    </a>
                    @if (isset($section['menu']['submenu']))
                    <ul class="sub-menu" @if (is_array($section['menu']['base'])) @foreach ($section['menu']['base'] as $base) {{ Request::is($base) ? 'style=display:block' : '' }} @endforeach @else {{ Request::is($section['menu']['base']) ? 'style=display:block' : '' }} @endif>
                        @foreach ($section['menu']['submenu'] as $submenu)

                            @if (isset($submenu['permissions']) && ! Auth::user()->hasPermissions($submenu['permissions']))
                                @continue
                            @endif

                            <li class="nav-item {{ (Request::fullUrl() == $submenu['url'] || Request::url() == $submenu['url']) ? 'active' : '' }}">
                                <a href="{{ $submenu['url'] }}" class="nav-link ">
                                    <i class="{{ $submenu['icon'] }}"></i>
                                    <span class="title">{{ $submenu['title'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
            @endforeach

            {{-- <li class="nav-item start ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start ">
                        <a href="index.html" class="nav-link ">
                            <i class="fa fa-bar-chart"></i>
                            <span class="title">Dashboard 1</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="heading">
                <h3 class="uppercase">Features</h3>
            </li>
            <li class="nav-item  ">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-users"></i>
                    <span class="title">UI Features</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  ">
                        <a href="ui_colors.html" class="nav-link ">
                            <span class="title">Color Library</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="heading">
                <h3 class="uppercase">Administradores</h3>
            </li> --}}
        </ul>
        
        @include('admin.layouts.partials.responsivesidebar')

        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->