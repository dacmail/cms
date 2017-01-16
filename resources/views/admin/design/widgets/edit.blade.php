@extends('admin.layouts.base')

@section('page.title')
    @include('admin.layouts.partials.pagetitletranslation', [
        'model' => $widget
    ])

    {{ str_limit($widget->title, 40, '...') }}<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::design::index') }}">Diseño</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::design::widgets::index') }}">Bloques</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::design::widgets::edit', ['id' => $widget->id]) }}">{{ str_limit($widget->title, 40, '...') }}</a>
    </li>
@stop

@section('content')

    @include('admin.layouts.partials.selectlang', [
        'model' => $widget,
        'route' => route('admin::design::widgets::delete_translation', ['id' => $widget->id])
    ])

    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form action="{{ route('admin::design::widgets::update', ['id' => $widget->id]) }}" method="POST" class="form-horizontal form-bordered form-label-stripped form-widget">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="langform" value="{{ $langform }}">
                <div class="form-group {{ $errors->has($langform.'.title') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.title')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="{{ $langform }}[title]" value="{{ $widget->hasTranslation($langform) ? $widget->translate($langform)->title : '' }}" class="form-control from-slug" required placeholder="{{ $widget->translate(config('app.locale'))->title }}">
                        {!! $errors->first($langform .'.title', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('order') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.order')) }}</label>
                    <div class="col-md-10">
                        <input type="number" name="order" value="{{ $widget->order }}" class="form-control" required>
                        {!! $errors->first('order', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('side') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.side')) }}</label>
                    <div class="col-md-10">
                        <select name="side" class="form-control">
                            @foreach(config('protecms.widgets.side') as $side)
                                <option value="{{ $side }}" {{ $widget->side == $side ? 'selected' : '' }}>{{ trans('widgets.side.' . $side) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('side', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.status')) }}</label>
                    <div class="col-md-10">
                        <select name="status" class="form-control">
                            @foreach(config('protecms.widgets.status') as $status)
                                <option value="{{ $status }}" {{ $widget->status == $status ? 'selected' : '' }}>{{ trans('widgets.status.' . $status) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('without_background') || $errors->has('without_title') || $errors->has('without_background_bottom') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.config')) }}</label>
                    <div class="col-md-10">
                        @foreach(config('protecms.widgets.config') as $config)
                            <label for="" class="control-label" {{ $loop->first ? 'style=padding:0' : '' }}>{{ trans('widgets.config.' . $config) }}</label>
                            <select name="config[{{ $config }}]" class="form-control">
                                    <option value="0">No</option>
                                    <option value="1" {{ isset($widget->config[$config]) ? 'selected' : '' }}>Si</option>
                            </select>
                        {!! $errors->first($config, '<span class="help-block">:message</span>') !!}
                        @endforeach
                    </div>
                </div>
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.type')) }}</label>
                    <div class="col-md-10">
                        <select name="type" class="form-control select-widget-type">
                            @foreach(config('protecms.widgets.type') as $type)
                                <option value="{{ $type }}" {{ $widget->type == $type ? 'selected' : '' }}>{{ trans('widgets.type.' . $type) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('type', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group" id="widget-custom" {{ $widget->type !== 'custom' ? 'style=display:none' : '' }}>
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.content')) }}</label>
                    <div class="col-md-10">
                        <textarea name="{{ $langform }}[content]" class="tinymce-upload">
                            {{ $widget->hasTranslation($langform) ? $widget->translate($langform)->content : '' }}
                        </textarea>
                    </div>
                </div>
                <div class="form-group" id="widget-menu" {{ $widget->type !== 'menu' ? 'style=display:none' : '' }}>
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.links')) }}</label>
                    <div class="col-md-10">
                        <div class="table-scrollable">
                            <table class="table table-center table-stripped">
                                <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Enlace</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($widget->links()->orderBy('order')->get() as $i => $link)
                                    <tr data-item="{{ $i }}">
                                        <td>
                                            <input type="hidden" name="links[{{ $i }}][id]" value="{{ $link->id }}">
                                            <input name="links[{{ $i }}][title]" class="form-control" required placeholder="{{ $link->translate(config('app.locale'))->title }}" value="{{ $link->hasTranslation($langform) ? $link->translate($langform)->title : '' }}">
                                            {!! $errors->first('translations.links.' . $langform . '.title"', '<span class="help-block">:message</span>') !!}
                                        </td>
                                        <td>
                                            <input name="links[{{ $i }}][link]" class="form-control" required placeholder="{{ $link->translate(config('app.locale'))->link }}" value="{{ $link->hasTranslation($langform) ? $link->translate($langform)->link : '' }}">
                                            {!! $errors->first('translations.links.' . $langform . '.link"', '<span class="help-block">:message</span>') !!}
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger pull-right delete-tr {{ $langform !== config('app.locale') ? 'hide' : '' }}"><i class="fa fa-trash-o"></i></button>
                                            <button type="button" class="btn btn-default pull-right down-tr"><i class="fa fa-arrow-down"></i></button>
                                            <button type="button" class="btn btn-default pull-right up-tr"><i class="fa fa-arrow-up"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-4 {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                            <span class="btn btn-default btn-block" id="add-widget-link">Añadir campo</span>
                        </div>
                        <div class="col-md-offset-4 col-md-4">
                            <span class="btn btn-default btn-block" data-toggle="modal" data-backdrop="static" data-target="#animal-link">Generar enlace de animales</span>
                        </div>

                    </div>
                </div>
                <div class="form-group" id="widget-protecms" {{ $widget->type !== 'protecms' ? 'style=display:none' : '' }}>
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.block')) }}</label>
                    <div class="col-md-10">
                        <select name="file" class="form-control">
                            @foreach(config('protecms.widgets.file') as $file)
                                <option value="{{ $file }}" {{ $widget->file == $file ? 'selected' : '' }}>{{ trans('widgets.file.' . $file) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('file', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <input type="submit" class="btn btn-block btn-primary" value="Actualizar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="animal-link" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Seleccione tantas opciones como quiera. <br>Si no selecciona ninguna opción de una sección, se incluirán todos. <br><small>(Ej. Si selecciona En adopción y Perro, se mostrarán todos los perros en adopción, de todos los géneros y de todas las localizaciónes)</small></p>
                        @foreach (['status', 'kind', 'gender', 'location'] as $filter)
                            <div class="col-md-12">
                                <p>{{ ucfirst(trans('validation.attributes.' . $filter)) }}:</p>
                                @foreach (config('protecms.animals.' . $filter) as $item)
                                    @if (in_array($filter, ['status', 'kind', 'gender']))
                                        <div class="col-md-4">
                                            <label><input type="checkbox" name="{{ $filter }}" value="1" id="{{ str_slug(trans('validation.attributes.' . $filter)) }}" data-url="{{ str_slug(trans_choice('validation.attributes.' . $filter, 2)) }}={{ str_slug(trans_choice('animals.' . $filter . '.' . $item, 2)) }}" data-filter="{{ $filter }}" data-item="{{ str_slug(trans_choice('animals.' . $filter . '.' . $item, 2)) }}"> {{ trans_choice('animals.' . $filter . '.' . $item, 2) }}</label>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <label><input type="checkbox" name="{{ $filter }}" value="1" id="{{ str_slug(trans('validation.attributes.' . $filter)) }}" data-url="{{ str_slug(trans('validation.attributes.' . $filter)) }}={{ str_slug(trans('animals.' . $filter . '.' . $item)) }}" data-filter="{{ $filter }}" data-item="{{ str_slug(trans('animals.' . $filter . '.' . $item)) }}"> {{ trans('animals.' . $filter . '.' . $item) }}</label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                        </div>
                        <div class="col-md-12 margin-top-40">
                            Enlace generado:
                            <div class="form-group">
                                <input type="text" class="form-control" value="/animales" id="animal-link-generated" readonly>
                                <span class="btn btn-primary margin-top-10 hide">Copiar</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>

        $('.select-widget-type').on('change', function() {
            $('#widget-menu').fadeOut(300, function() {
                $(this).css('display', 'none');
            });
            $('#widget-custom').fadeOut(300, function() {
                $(this).css('display', 'none');
            });
            $('#widget-protecms').fadeOut(300, function() {
                $(this).css('display', 'none');
            });

            $('#widget-' + $('.select-widget-type option:selected').val()).fadeIn(300, function() {
                $(this).css('display', 'block');
            });
        });

        var base = '/animales?';
        var link = $('#animal-link-generated');

        $('#animal-link').on('change', function() {
            var url = base;
            var status_checkbox = $('input[type="checkbox"][name="status"]:checked');
            var kind_checkbox = $('input[type="checkbox"][name="kind"]:checked');
            var gender_checkbox = $('input[type="checkbox"][name="gender"]:checked');
            var location_checkbox = $('input[type="checkbox"][name="location"]:checked');

            if (status_checkbox.length) {
                url = url + '{{ str_slug(trans_choice('validation.attributes.status', 2)) }}=';
                status_checkbox.each(function (item) {
                    url = url + $(this).data('item') + ',';
                });

                url = url.slice(0, -1);
                url = url + '&';
            }
            if (kind_checkbox.length) {
                url = url + '{{ str_slug(trans_choice('validation.attributes.kind', 2)) }}=';
                kind_checkbox.each(function (item) {
                    url = url + $(this).data('item') + ',';
                });

                url = url.slice(0, -1);
                url = url + '&';
            }
            if (gender_checkbox.length) {
                url = url + '{{ str_slug(trans_choice('validation.attributes.gender', 2)) }}=';
                gender_checkbox.each(function (item) {
                    url = url + $(this).data('item') + ',';
                });

                url = url.slice(0, -1);
                url = url + '&';
            }
            if (location_checkbox.length) {
                url = url + '{{ str_slug(trans('validation.attributes.location')) }}=';
                location_checkbox.each(function (item) {
                    url = url + $(this).data('item') + ',';
                });

                url = url.slice(0, -1);
                url = url + '&';
            }

            url = url.slice(0, -1);

            link.val(url);
        });
    </script>
@endpush

@section('page.help.text')
    <p>En esta página se puede editar un bloque de la protectora.</p>
    <p>Existen 3 tipos de bloque:</p>
    <ul>
        <li><strong>Menú</strong><br>Con el bloque de tipo menú se pueden crear menus e ir añadiendo enlaces a los mismos.</li>
        <li><strong>Personalizado</strong><br>En los bloques personalizados se puede añadir el texto e imágenes que se desee. Ideal para añadir banners, carteles, secciones con imágenes...</li>
        <li><strong>ProteCMS</strong><br>Son bloques complejos que provee el sistema, como el bloque de últimas fichas o el buscador de animales.</li>
    </ul>
    <p>Puede generar enlaces complejos de animales haciendo clic en el botón:</p>
    <p><button class="btn btn-default">Generar enlace de animales</button></p>
    <p class="bg-info">
        Cuando haga clic se abrirá una ventana en la que podrá ir indicando qué estado, especie, género o localización quiere mostrar. Si no selecciona ninguno de alguna sección (por ejemplo no selecciona ningún filtro de Estado) se mostrarán todos los animales de todos los estados.
    </p>

    <p>Se pueden añadir traducciones haciendo clic en el desplegable llamado "Cambiar traducción".</p>
    <p>También puede ordenar o eliminar los enlaces haciendo clic en los siguientes botones que aparecen en la página:</p>
    <p>
        <button class="btn btn-default"><i class="fa fa-arrow-up"></i></button>
        <button class="btn btn-default"><i class="fa fa-arrow-down"></i></button>
        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
    </p>

    <h4>Campos del formulario</h4>
    <p><strong>Orden:</strong><br> Orden de aparición en la página web.</p>
    <p><strong>Lado:</strong><br> Lado de aparición en la página web.</p>
@stop