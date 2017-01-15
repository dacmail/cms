@extends('admin.layouts.base')

@section('page.title')
    Publicar página<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::pages::index') }}">Páginas</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::pages::create') }}">Publicar página</a>
    </li>
@stop

@section('content')
    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form action="{{ route('admin::panel::pages::store') }}" method="POST" class="form-horizontal form-bordered form-label-stripped">
                {{ csrf_field() }}
                <input type="hidden" name="langform" value="{{ $langform }}">
                <div class="form-group {{ $errors->has($langform.'.title') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.title')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="{{ $langform }}[title]" value="{{ old($langform .'.title') }}" class="form-control from-slug" data-lang="{{ config('app.locale') }}" required>
                        {!! $errors->first($langform .'.title', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform.'.slug') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.slug')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="{{ $langform }}[slug]" value="{{ old($langform .'.slug') }}" class="form-control to-slug" data-lang="{{ config('app.locale') }}" required>
                        {!! $errors->first($langform .'.slug', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.published_at')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="published_at" value="{{ ! old('published_at') ? date('d-m-Y H:i') : old('published_at') }}" class="form-control datetimepicker" required>
                        {!! $errors->first('published_at', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('form_id') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.form')) }}</label>
                    <div class="col-md-10">
                        <select name="form_id" class="form-control">
                            <option value="">-</option>
                            @foreach ($web->forms as $form)
                                <option value="{{ $form->id }}" {{ old('form_id') == $form->id ? 'selected' : '' }}>{{ $form->title }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('form_id', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform.'.user_id') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.author')) }}</label>
                    <div class="col-md-10">
                        <select name="{{ $langform }}[user_id]" class="form-control" required>
                            @foreach ($web->volunteers as $user)
                                <option value="{{ $user->id }}" {{ $user->id == Request::user()->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first($langform.'.user_id', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.status')) }}</label>
                    <div class="col-md-10">
                        <select name="status" class="form-control" placeholder="Estado...">
                            @foreach(config('protecms.pages.status') as $status)
                                <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ trans('pages.status.' . $status) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform.'.text') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.text')) }}</label>
                    <div class="col-md-10">
                        <textarea name="{{ $langform }}[text]" class="form-control tinymce-upload"></textarea>
                        {!! $errors->first($langform .'.text', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-5 col-md-2">
                            <input type="submit" class="btn btn-block btn-primary" value="Publicar">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('page.help.text')
    <p>En esta página se puede crear una página en la protectora.</p>
    <p class="bg-info">La diferencia entre artículos y páginas, es que los artículos son para publicar noticias, novedades, eventos, etc, y las páginas son para contenido más estático, por ejemplo, páginas como "quiénes somos", "voluntario", "cómo colaborar", etc.</p>

    <h4>Campos del formulario</h4>
    <p><strong>Formulario:</strong><br> Inserta un formulario ya generado en la página.</p>
@stop
