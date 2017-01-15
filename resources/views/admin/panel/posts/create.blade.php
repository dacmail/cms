@extends('admin.layouts.base')

@section('page.title')
    Publicar artículo<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::posts::index') }}">Artículos</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::posts::create') }}">Publicar artículo</a>
    </li>
@stop

@section('content')
    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form action="{{ route('admin::panel::posts::store') }}" method="POST" class="form-horizontal form-bordered form-label-stripped">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has(config('app.locale').'.title') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.title')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="{{ config('app.locale') }}[title]" value="{{ old(config('app.locale').'.title') }}" class="form-control from-slug" required>
                        {!! $errors->first(config('app.locale') .'.title', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has(config('app.locale').'.slug') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.slug')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="{{ config('app.locale') }}[slug]" value="{{ old(config('app.locale').'.slug') }}" class="form-control to-slug" required>
                        {!! $errors->first(config('app.locale') .'.slug', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('fixed') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* Fijo en la página principal</label>
                    <div class="col-md-10">
                        <select name="fixed" class="form-control" required>
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                        {!! $errors->first('fixed', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.published_at')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="published_at" value="{{ ! old('published_at') ? date('d-m-Y H:i:s') : old('published_at') }}" class="form-control datetimepicker" required>
                        {!! $errors->first('published_at', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.category_id')) }}</label>
                    <div class="col-md-10">
                        <select name="category_id" class="form-control" required>
                            @foreach ($web->posts_categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}
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
                <div class="form-group {{ $errors->has(config('app.locale') . '.user_id') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.author')) }}</label>
                    <div class="col-md-10">
                        <select name="{{ config('app.locale') }}[user_id]" class="form-control" required>
                            @foreach ($web->volunteers as $user)
                                <option value="{{ $user->id }}" {{ $user->id == Request::user()->id ? 'selected' : '' }} {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first(config('app.locale') . '.user_id', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.status')) }}</label>
                    <div class="col-md-10">
                        <select name="status" class="form-control" placeholder="Estado...">
                            @foreach(config('protecms.posts.status') as $status)
                                <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ trans('posts.status.' . $status) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('comments_status') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.comments_status')) }}</label>
                    <div class="col-md-10">
                        <select name="comments_status" class="form-control" placeholder="Estado...">
                            @foreach(config('protecms.posts.comments_status') as $comments_status)
                                <option value="{{ $comments_status }}" {{ old('comments_status') == $comments_status ? 'selected' : '' }}>{{ trans('posts.comments_status.' . $comments_status) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('comments_status', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has(config('app.locale').'.text') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.text')) }}</label>
                    <div class="col-md-10">
                        <textarea name="{{ config('app.locale') }}[text]" class="form-control tinymce-upload">{{ old(config('app.locale') . '.text') }}</textarea>
                        {!! $errors->first(config('app.locale') .'.text', '<span class="help-block">:message</span>') !!}
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
    <p>En esta página se puede crear un artículo en la protectora.</p>
    <p class="bg-info">La diferencia entre artículos y páginas, es que los artículos son para publicar noticias, novedades, eventos, etc, y las páginas son para contenido más estático, por ejemplo, páginas como "quiénes somos", "voluntario", "cómo colaborar", etc.</p>

    <h4>Campos del formulario</h4>
    <p><strong>Fijo en la página principal:</strong><br> Si el artículo está fijo en la página principal, siempre aparecerá primero.</p>
    <p><strong>Formulario:</strong><br> Inserta un formulario ya generado en el artículo.</p>
@stop
