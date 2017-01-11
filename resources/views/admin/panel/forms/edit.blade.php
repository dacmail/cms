@extends('admin.layouts.base')

@section('page.title')
    @include('admin.layouts.partials.pagetitletranslation', [
        'model' => $form
    ])

    {{ str_limit($form->title, 40, '...') }}<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::forms::index') }}">Formularios</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::forms::edit', ['id' => $form->id]) }}">{{ str_limit($form->title, 40, '...') }}</a>
    </li>
@stop

@section('content')

    @include('admin.layouts.partials.selectlang', [
        'model' => $form,
        'route' => route('admin::panel::forms::delete_translation', ['id' => $form->id])
    ])

    @foreach ($errors->all() as $error) {{ $error }} @endforeach

    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form action="{{ route('admin::panel::forms::update', ['id' => $form->id]) }}" method="POST" class="form-horizontal form-bordered form-label-stripped form-form">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="langform" value="{{ $langform }}">
                <div class="form-group {{ $errors->has($langform.'.title') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.title')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="{{ $langform }}[title]" value="{{ $form->hasTranslation($langform) ? $form->translate($langform)->title : '' }}" class="form-control from-slug" required placeholder="{{ $form->translate(config('app.locale'))->title }}">
                        {!! $errors->first($langform . '.title', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform.'.slug') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.slug')) }}</label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-addon">{{ $web->getUrl() . '/' . trans_choice('routes.forms', 1) . '/' . $form->id . '-' }}</span>
                            <input type="text" name="{{ $langform }}[slug]" value="{{ $form->hasTranslation($langform) ? $form->translate($langform)->slug : '' }}" class="form-control to-slug" required placeholder="{{ $form->translate(config('app.locale'))->slug }}">
                        </div>
                        <div class="alert alert-info text-center margin-top-10">
                            Si modifica el enlace puede afectar a los usuarios que accedan al antiguo.
                        </div>
                        {!! $errors->first($langform . '.slug', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform.'.subject') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.subject')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="{{ $langform }}[subject]" value="{{ $form->hasTranslation($langform) ? $form->translate($langform)->subject : '' }}" class="form-control" required placeholder="{{ $form->translate(config('app.locale'))->slug }}">
                        {!! $errors->first($langform . '.subject', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* Email que lo recibirá</label>
                    <div class="col-md-10">
                        <input type="email" name="email" value="{{ $form->email }}" class="form-control" required>
                        {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform . '.user_id') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.author')) }}</label>
                    <div class="col-md-10">
                        <select name="{{ $langform }}[user_id]" class="form-control" required>
                            @foreach ($web->volunteers as $user)
                                <option value="{{ $user->id }}" {{ $form->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first($langform . '.user_id', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.status')) }}</label>
                    <div class="col-md-10">
                        <select name="status" class="form-control" placeholder="Estado...">
                            @foreach(config('protecms.forms.status') as $status)
                                <option value="{{ $status }}" {{ $form->status == $status ? 'selected' : '' }}>{{ trans('forms.status.' . $status) }}</option>
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
                                    <th class="{{ $langform !== config('app.locale') ? 'hide' : '' }}">Tipo</th>
                                    <th class="{{ $langform !== config('app.locale') ? 'hide' : '' }}">Obligatorio</th>
                                    <th>Acciones</th>
                                </thead>
                                <tbody>
                                    @foreach ($form->fields()->orderBy('order')->get() as $i => $field)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="fields[{{ $i }}][id]" value="{{ $field->id }}">
                                                <input name="fields[{{ $i }}][title]" class="form-control" required placeholder="{{ $field->translate(config('app.locale'))->title }}" value="{{ $field->hasTranslation($langform) ? $field->translate($langform)->title : '' }}">
                                                {!! $errors->first('translations.field.' . $langform . '.title"', '<span class="help-block">:message</span>') !!}
                                            </td>
                                            <td class="{{ $langform !== config('app.locale') ? 'hide' : '' }}">
                                                <select name="fields[{{ $i }}][type]" class="form-control" required>
                                                    @foreach(config('protecms.forms.fields.type') as $type)
                                                        <option value="{{ $type }}" {{ $field->type == $type ? 'selected' : '' }}>{{ trans('forms.fields.type.' . $type) }}</option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                                            </td>
                                            <td class="{{ $langform !== config('app.locale') ? 'hide' : '' }}">
                                                <select name="fields[{{ $i }}][required]" class="form-control" required>
                                                    @foreach(config('protecms.forms.fields.required') as $required)
                                                        <option value="{{ $required }}" {{ $field->required == $required ? 'selected' : '' }}>{{ trans('forms.fields.required.' . $required) }}</option>
                                                    @endforeach
                                                </select>
                                                {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
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

                        <div class="col-md-offset-4 col-md-4 {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                            <button type="button" class="btn btn-default btn-block" id="add-form-field">Añadir campo</button>
                        </div>

                        {!! $errors->first('fields', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform.'.text') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.text')) }}</label>
                    <div class="col-md-10">

                        @include('admin.layouts.partials.maintranslationtext', [
                            'model' => $form,
                            'field' => 'text'
                        ])

                        <textarea name="{{ $langform }}[text]" class="form-control tinymce-upload">{{ $form->hasTranslation($langform) ? $form->translate($langform)->text : '' }}</textarea>
                        {!! $errors->first($langform . '.text"', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <input type="submit" class="btn btn-block btn-primary" value="{{ $form->hasTranslation($langform) ? 'Actualizar' : 'Publicar traducción' }}">
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
