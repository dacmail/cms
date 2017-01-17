@extends('admin.layouts.base')

@section('page.title')
    Crear formulario<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::forms::index') }}">Formularios</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::forms::create') }}">Crear formulario</a>
    </li>
@stop

@section('content')

    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form action="{{ route('admin::panel::forms::store') }}" method="POST" class="form-horizontal form-bordered form-label-stripped form-form">
                {{ csrf_field() }}
                <input type="hidden" name="langform" value="{{ $langform }}">
                <div class="form-group {{ $errors->has($langform.'.title') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.title')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="{{ $langform }}[title]" value="{{ old($langform . '.title') }}" class="form-control from-slug" required>
                        {!! $errors->first($langform . '.title', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform.'.slug') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.slug')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="{{ $langform }}[slug]" value="{{ old($langform . '.slug') }}" class="form-control to-slug" required>
                        {!! $errors->first($langform . '.slug', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform.'.subject') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.subject')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="{{ $langform }}[subject]" value="{{ old($langform . '.subject') }}" class="form-control" required>
                        {!! $errors->first($langform . '.subject', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* Email que lo recibirá</label>
                    <div class="col-md-10">
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform . '.user_id') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.author')) }}</label>
                    <div class="col-md-10">
                        <select name="{{ $langform }}[user_id]" class="form-control" required>
                            @foreach ($web->volunteers as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first($langform . '.user_id', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.status')) }}</label>
                    <div class="col-md-10">
                        <select name="status" class="form-control">
                            @foreach(config('protecms.forms.status') as $status)
                                <option value="{{ $status }}">{{ trans('forms.status.' . $status) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('fields') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.fields')) }}</label>
                    <div class="col-md-10">
                        <div class="table-scrollable">
                            <table class="table table-center table-stripped">
                                <thead>
                                <th>Título</th>
                                <th>Tipo</th>
                                <th>Obligatorio</th>
                                <th>Acciones</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-offset-4 col-md-4 margin-top-20 margin-bottom-20">
                            <button type="button" class="btn btn-default btn-block" id="add-form-field">Añadir campo</button>
                        </div>
                        <div class="clearfix"></div>
                        {!! $errors->first('fields', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform.'.text') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.text')) }}</label>
                    <div class="col-md-10">
                        <textarea name="{{ $langform }}[text]" class="form-control tinymce-upload">{{ old($langform . '.text') }}</textarea>
                        {!! $errors->first($langform . '.text"', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-5 col-md-2">
                            <input type="submit" class="btn btn-block btn-primary" value="Crear formulario">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@push('scripts')
<script>
    $('#add-form-field').on('click', function() {
        var total_links = $('.form-form tbody tr').length;

        $('.form-form tbody').append(
                $('<tr>' +
                        '<td>' +
                        '<input name="fields[' + total_links + '][title]" class="form-control" required value="">' +
                        '</td>' +
                        '<td>' +
                        '<select name="fields[' + total_links + '][type]" class="form-control" required>' +
                        '@foreach(config('protecms.forms.fields.type') as $type)' +
                        '<option value="{{ $type }}">{{ trans('forms.fields.type.' . $type) }}</option>' +
                        '@endforeach' +
                        '</select>' +
                        '</td>' +
                        '<td>' +
                        '<select name="fields[' + total_links + '][required]" class="form-control" required>' +
                        '@foreach(config('protecms.forms.fields.required') as $required)' +
                        '<option value="{{ $required }}">{{ trans('forms.fields.required.' . $required) }}</option>' +
                        '@endforeach' +
                        '</select>' +
                        '</td>' +
                        '<td>' +
                        '<button type="button" class="btn btn-danger pull-right delete-tr"><i class="fa fa-trash-o"></i></button>' +
                        '<button type="button" class="btn btn-default pull-right down-tr"><i class="fa fa-arrow-down"></i></button>' +
                        '<button type="button" class="btn btn-default pull-right up-tr"><i class="fa fa-arrow-up"></i></button>' +
                        '</td>' +
                        '<tr>')
        );
    });
</script>
@endpush

@section('page.help.text')
    <p>En esta página se puede crear un formulario en la protectora.</p>

    <h4>Campos del formulario</h4>
    <p><strong>Campos:</strong><br> Aquí se pueden ir añadiendo los distintos campos que tendrá el formulario e indicando si son obligatorios, reordenándolos e indicar su tipo.</p>
@stop
