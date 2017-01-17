@extends('admin.layouts.base')

@section('page.title')
    @include('admin.layouts.partials.pagetitletranslation', [
        'model' => $post
    ])

    {{ str_limit($post->title, 40, '...') }}<p class="pull-right" style="margin-top:0"><small>Los campos con * son obligatorios.</small></p>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::posts::index') }}">Artículos</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::posts::edit', ['id' => $post->id]) }}">{{ str_limit($post->title, 40, '...') }}</a>
    </li>
@stop

@section('content')

    @include('admin.layouts.partials.selectlang', [
        'model' => $post,
        'route' => route('admin::panel::posts::delete_translation', ['id' => $post->id])
    ])

    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form action="{{ route('admin::panel::posts::update', ['id' => $post->id]) }}" method="POST" class="form-horizontal form-bordered form-label-stripped">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="langform" value="{{ $langform }}">
                <div class="form-group {{ $errors->has($langform.'.title') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.title')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="{{ $langform }}[title]" value="{{ $post->hasTranslation($langform) ? $post->translate($langform)->title : '' }}" class="form-control from-slug" required placeholder="{{ $post->translate(config('app.locale'))->title }}">
                        {!! $errors->first($langform .'.title', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform.'.slug') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.slug')) }}</label>
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-addon">{{ $web->getUrl() . '/' . trans_choice('routes.posts', 1) . '/' . $post->id . '-' }}</span>
                            <input type="text" name="{{ $langform }}[slug]" value="{{ $post->hasTranslation($langform) ? $post->translate($langform)->slug : '' }}" class="form-control to-slug" required placeholder="{{ $post->translate(config('app.locale'))->slug }}">
                        </div>
                        <div class="alert alert-info text-center margin-top-10">
                            Si modifica el enlace puede afectar a los usuarios que accedan al antiguo.
                        </div>
                        {!! $errors->first($langform.'.slug', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('fixed') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* Fijo en la página principal</label>
                    <div class="col-md-10">
                        <select name="fixed" class="form-control" required>
                            <option value="0">No</option>
                            <option value="1" {{ $post->fixed ? 'selected' : '' }}>Si</option>
                        </select>
                        {!! $errors->first('fixed', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('published_at') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.published_at')) }}</label>
                    <div class="col-md-10">
                        <input type="text" name="published_at" value="{{ $post->published_at->format('d-m-Y H:i:s') }}" class="form-control datetimepicker" required>
                        {!! $errors->first('published_at', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('form_id') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.form')) }}</label>
                    <div class="col-md-10">
                        <select name="form_id" class="form-control">
                            <option value="">-</option>
                            @foreach ($web->forms as $form)
                                <option value="{{ $form->id }}" {{ $post->form_id == $form->id ? 'selected' : '' }}>{{ $form->title }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('form_id', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.category_id')) }}</label>
                    <div class="col-md-10">
                        <select name="category_id" class="form-control" required>
                            @foreach ($web->posts_categories as $category)
                                <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform.'.user_id') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.author')) }}</label>
                    <div class="col-md-10">
                        <select name="{{ $langform }}[user_id]" class="form-control" required>
                            @foreach ($web->volunteers as $user)
                                <option value="{{ $user->id }}" {{ $post->hasTranslation($langform) ? $post->translate($langform)->user_id == $user->id ? 'selected' : '' : Auth::user()->id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first($langform.'.user_id', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.status')) }}</label>
                    <div class="col-md-10">
                        <select name="status" class="form-control">
                            @foreach(config('protecms.posts.status') as $status)
                                <option value="{{ $status }}" {{ $post->status == $status ? 'selected' : '' }}>{{ trans('posts.status.' . $status) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has('comments_status') ? 'has-error' : '' }} {{ $langform !== config('app.locale') ? 'hide' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.comments_status')) }}</label>
                    <div class="col-md-10">
                        <select name="comments_status" class="form-control">
                            @foreach(config('protecms.posts.comments_status') as $comments_status)
                                <option value="{{ $comments_status }}" {{ $post->comments_status == $comments_status ? 'selected' : '' }}>{{ trans('posts.comments_status.' . $comments_status) }}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('comments_status', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform.'.text') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.text')) }}</label>
                    <div class="col-md-10">

                        @include('admin.layouts.partials.maintranslationtext', [
                            'model' => $post,
                            'field' => 'text'
                        ])

                        <textarea name="{{ $langform }}[text]" class="form-control tinymce-upload">{{ $post->hasTranslation($langform) ? $post->translate($langform)->text : '' }}</textarea>
                        {!! $errors->first($langform .'.text', '<span class="help-block">:message</span>') !!}
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <input type="submit" class="btn btn-block btn-primary" value="{{ $post->hasTranslation($langform) ? 'Actualizar' : 'Publicar traducción' }}">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop

@section('page.help.text')
    <p>En esta página se puede editar un artículo de la protectora.</p>
    <p>También se pueden añadir traducciones haciendo clic en el desplegable llamado "Cambiar traducción".</p>
    <p class="bg-info">Si modifica el enlace, el artículo no será accesible por el enlace antiguo, por lo tanto si ha compartido el artículo, por ejemplo en redes sociales, se perderá el acceso a este.</p>

    <h4>Campos del formulario</h4>
    <p><strong>Fijo en la página principal:</strong><br> Si el artículo está fijo en la página principal, siempre aparecerá primero.</p>
    <p><strong>Formulario:</strong><br> Inserta un formulario ya generado en el artículo.</p>
@stop
