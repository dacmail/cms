@extends('admin.layouts.base')

@section('page.title')
    @include('admin.layouts.partials.pagetitletranslation', [
        'model' => $page
    ])

    {{ str_limit($page->title, 40, '...') }}<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::pages::index') }}">Páginas</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::pages::edit', ['id' => $page->id]) }}">{{ str_limit($page->title, 40, '...') }}</a>
    </li>
@stop

@section('content')
    @include('admin.layouts.partials.selectlang', [
        'model' => $page,
        'route' => route('admin::panel::pages::delete_translation', ['id' => $page->id])
    ])

    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form action="{{ route('admin::panel::pages::update', ['id' => $page->id]) }}" method="POST" class="form-horizontal form-bordered form-label-stripped">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="langform" value="{{ $langform }}">
                <div class="form-group {{ $errors->has($langform.'.title') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.title')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="{{ $langform }}[title]" value="{{ $page->hasTranslation($langform) ? $page->translate($langform)->title : '' }}" class="form-control from-slug" required placeholder="{{ $page->translate(config('app.locale'))->title }}">
                        {!! $errors->first($langform . '.title', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform.'.slug') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.slug')) }}</label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-addon">{{ $web->getUrl() . '/' . trans_choice('routes.pages', 1) . '/' . $page->id . '-' }}</span>
                            <input type="text" name="{{ $langform }}[slug]" value="{{ $page->hasTranslation($langform) ? $page->translate($langform)->slug : '' }}" class="form-control to-slug" required placeholder="{{ $page->translate(config('app.locale'))->title }}">
                        </div>
                        <div class="alert alert-info text-center margin-top-10">
                            Si modifica el enlace puede afectar a los usuarios que accedan al antiguo.
                        </div>
                        {!! $errors->first($langform . '.slug', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.published_at')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="published_at" value="{{ $page->published_at->format('d-m-Y H:i:s') }}" class="form-control datetimepicker" required>
                        {!! $errors->first('published_at', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform.'.user_id') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.author')) }}</label>
                    <div class="col-md-10">
                        <select name="{{ $langform }}[user_id]" class="form-control" required>
                            @foreach ($web->volunteers as $user)
                                <option value="{{ $user->id }}" {{ $page->hasTranslation($langform) ? $page->translate($langform)->user_id == $user->id ? 'selected' : '' : Auth::user()->id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first($langform.'.user_id', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('form_id') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.form')) }}</label>
                    <div class="col-md-10">
                        <select name="form_id" class="form-control">
                            <option value="">-</option>
                            @foreach ($web->forms as $form)
                                <option value="{{ $form->id }}" {{ $page->form_id == $form->id ? 'selected' : '' }}>{{ $form->title }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('form_id', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.status')) }}</label>
                    <div class="col-md-10">
                        <select name="status" class="form-control">
                            @foreach(config('protecms.pages.status') as $status)
                                <option value="{{ $status }}" {{ $page->status == $status ? 'selected' : '' }}>{{ trans('pages.status.' . $status) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform.'.text') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.text')) }}</label>
                    <div class="col-md-10">

                        @include('admin.layouts.partials.maintranslationtext', [
                            'model' => $page,
                            'field' => 'text'
                        ])

                        <textarea name="{{ $langform }}[text]" class="form-control tinymce-upload">{{ $page->hasTranslation($langform) ? $page->translate($langform)->text : '' }}</textarea>
                        {!! $errors->first($langform . '.text', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <input type="submit" class="btn btn-block btn-primary" value="{{ $page->hasTranslation($langform) ? 'Actualizar' : 'Publicar traducción' }}">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop
