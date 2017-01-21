<div class="page-sidebar-wrapper">
    <ul class="responsive-megamenu visible-sm visible-xs">
        <li><a href="{{ route('admin::panel::index') }}" class="btn btn-primary">Panel</a></li>
        <li><a href="{{ route('admin::design::index') }}" class="btn btn-primary">Página web</a></li>
        <li><a href="{{ route('admin::calendar::index') }}" class="btn btn-primary">Calendario</a></li>
        <li><a href="{{ route('admin::finances::index') }}" class="btn btn-primary">Finanzas</a></li>
        <li><a href="{{ route('admin::support::index') }}" class="btn btn-primary">Soporte</a></li>
    </ul>
    <!-- BEGIN RESPONSIVE MENU FOR HORIZONTAL & SIDEBAR MENU -->
    <ul class="page-sidebar-menu page-header-fixed visible-sm visible-xs" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        @foreach ($sidebar as $key => $section)
            <li class="nav-item @if (is_array($section['menu']['base'])) @foreach ($section['menu']['base'] as $base) {{ Request::is($base) ? 'open' : '' }} @endforeach @else {{ Request::is($section['menu']['base']) ? 'open' : '' }} @endif {{ $key == 0 ? 'start' : '' }}">
                <a href="{{ $section['menu']['url'] }}" class="nav-link nav-toggle">
                    <i class="{{ $section['menu']['icon'] }}"></i>
                    <span class="title">{{ $section['menu']['title'] }}</span>
                    @if (isset($section['menu']['submenu']))
                        <span class="arrow @if (is_array($section['menu']['base'])) @foreach ($section['menu']['base'] as $base) {{ Request::is($base) ? 'open' : '' }} @endforeach @else {{ Request::is($section['menu']['base']) ? 'open' : '' }} @endif"></span>
                    @endif
                </a>
                @if (isset($section['menu']['submenu']))
                    <ul class="sub-menu" @if (is_array($section['menu']['base'])) @foreach ($section['menu']['base'] as $base) {{ Request::is($base) ? 'style=display:block' : '' }} @endforeach @else {{ Request::is($section['menu']['base']) ? 'style=display:block' : '' }} @endif>
                        @foreach ($section['menu']['submenu'] as $submenu_key => $submenu)
                            <li class="nav-item {{ $submenu_key }}">
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
    </ul>
</div>