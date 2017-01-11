@extends('admin.layouts.base')

@section('page.title')
    {{ str_limit($post->title, 70, '...') }}
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
        'model' => $post
    ])

    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form class="form-horizontal form-bordered form-label-stripped">
                <div class="form-group">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.title')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ $post->translate($langform)->title }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.slug')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ route('web::posts::show', ['id' => $post->id, 'slug' => $post->translate('es')->slug]) }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.published_at')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ $post->published_at->format('d-m-Y H:i') }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.form')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ $post->form->title or '-' }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.category_id')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ $post->category->title }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.author')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ $post->author->name }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.status')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ trans('posts.status.' . $post->status) }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.comments_status')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ trans('posts.comments_status.' . $post->comments_status) }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.text')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{!! $post->translate($langform)->text !!}</p>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <a href="{{ route('admin::panel::posts::index') }}" class="btn btn-block btn-primary">Volver al listado</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop