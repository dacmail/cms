<img src="{{ $animal->photos()->orderBy('main', 'DESC')->first()->thumbnail_url or Theme::url('images/animal-default.jpg') }}" class="img-responsive img-thumbnail center-block animalmenu-photo">

<div class="list-group margin-top-40">
    
    <a href="{{ route('admin::panel::animals::edit', ['id' => $animal->id]) }}" class="list-group-item {{ Request::is('admin/panel/animals/'.$animal->id.'/edit') ? 'active' : '' }}"><i class="fa fa-paw"></i> Datos</a>

    <a href="{{ route('admin::panel::animals::photos::index', ['id' => $animal->id]) }}" class="list-group-item {{ Request::is('admin/panel/animals/*/photos*') ? 'active' : '' }}"><i class="fa fa-photo"></i> Fotos</a>

    <a href="{{ route('admin::panel::animals::photos::index', ['id' => $animal->id]) }}" class="list-group-item hide {{ Request::is('admin/panel/animals/*/videos*') ? 'active' : '' }}"><i class="fa fa-video-camera"></i> Vídeos</a>

    <div class="collapse-block" id="health-collapse">
        <a href="#collapseHealth" class="list-group-item {{ Request::is('admin/panel/animals/*/health*') ? 'active' : '' }}" data-toggle="collapse" data-parent="#health-collapse" aria-expanded="false" aria-controls="collapseHealth"><i class="fa fa-medkit"></i> Salud <i class="fa fa-caret-down pull-right"></i></a>
        <div id="collapseHealth" class="{{ Request::is('admin/panel/animals/*/health*') ? '' : 'collapse' }}">
            <a href="{{ route('admin::panel::animals::health::index', ['id' => $animal->id]) }}" class="list-group-item {{ Request::is('admin/panel/animals/*/health') ? 'active' : '' }}" style="padding-left: 30px"><i class="fa fa-list-ul"></i> Listado</a>
            <a href="{{ route('admin::panel::animals::health::create', ['id' => $animal->id]) }}" class="list-group-item {{ Request::is('admin/panel/animals/*/health/create') ? 'active' : '' }}" style="padding-left: 30px"><i class="fa fa-plus-square"></i> Añadir salud</a>
        </div>
    </div>

    <div class="collapse-block" id="sponsorships-collapse">
        <a href="#collapseSponsorships" class="list-group-item {{ Request::is('admin/panel/animals/*/sponsorships*') ? 'active' : '' }}" data-toggle="collapse" data-parent="#sponsorships-collapse" aria-expanded="false" aria-controls="collapseSponsorships"><i class="fa fa-users"></i> Apadrinamientos <i class="fa fa-caret-down pull-right"></i></a>
        <div id="collapseSponsorships" class="{{ Request::is('admin/panel/animals/*/sponsorships*') ? '' : 'collapse' }}">
            <a href="{{ route('admin::panel::animals::sponsorships::index', ['id' => $animal->id]) }}" class="list-group-item {{ Request::is('admin/panel/animals/*/sponsorships') ? 'active' : '' }}" style="padding-left: 30px"><i class="fa fa-list-ul"></i> Listado</a>
            <a href="{{ route('admin::panel::animals::sponsorships::create', ['id' => $animal->id]) }}" class="list-group-item {{ Request::is('admin/panel/animals/*/sponsorships/create') ? 'active' : '' }}" style="padding-left: 30px"><i class="fa fa-plus-square"></i> Añadir apadrinamiento</a>
        </div>
    </div>

    <div class="collapse-block hidden-xs" id="export-collapse">
        <a href="#collapseExport" class="list-group-item {{ Request::is('admin/panel/animals/*/export*') ? 'active' : '' }}" data-toggle="collapse" data-parent="#export-collapse" aria-expanded="false" aria-controls="collapseExport"><i class="fa fa-download"></i> Exportar ficha <i class="fa fa-caret-down pull-right"></i></a>
        <div id="collapseExport" class="{{ Request::is('admin/panel/animals/*/export*') ? '' : 'collapse' }}">
            <a href="{{ route('admin::panel::animals::export::pdf', ['id' => $animal->id]) }}" class="list-group-item {{ Request::is('admin/panel/animals/*/export') ? 'active' : '' }}" style="padding-left: 30px"><i class="fa fa-file-pdf-o"></i> PDF</a>
            <a href="{{ route('admin::panel::animals::export::word', ['id' => $animal->id]) }}" class="list-group-item {{ Request::is('admin/panel/animals/*/export/create') ? 'active' : '' }} hide" style="padding-left: 30px"><i class="fa fa-file-word-o"></i> Word</a>
        </div>
    </div>

    <a href="javascript:;" class="list-group-item hide {{ Request::is('admin/panel/animals/*/notes') ? 'active' : '' }}"><i class="fa fa-file-o"></i> Notas</a>

    <a href="javascript:;" class="list-group-item hide {{ Request::is('admin/panel/animals/*/tracking') ? 'active' : '' }}"><i class="fa fa-file-text-o"></i> Apadrinamientos</a>

    <a href="{{ route('web::animals::show', ['id' => $animal->id]) }}" class="list-group-item"><i class="fa fa-link"></i> Ver en la web</a>
</div>