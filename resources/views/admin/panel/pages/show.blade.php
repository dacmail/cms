@extends('admin.layouts.base')

@section('page.title')
    {{ str_limit($page->title, 70, '...') }}
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
        'model' => $page
    ])

    <div class="portlet light bordered form-fit">
        <div class="portlet-body form">
            <form class="form-horizontal form-bordered form-label-stripped">
                <div class="form-group">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.title')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ $page->translate($langform)->title }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.slug')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ $page->translate($langform)->title }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.published_at')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ $page->published_at->format('d-m-Y H:i') }}</p>
                    </div>
                </div>
                <div class="form-group {{ $errors->has($langform.'.user_id') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.author')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ $page->author->name }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.form')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ $page->form->title or '-' }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.status')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{{ trans('pages.status.' . $page->status) }}</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.text')) }}</label>
                    <div class="col-md-10">
                        <p class="form-control-static">{!! $page->translate($langform)->text !!}</p>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-4">
                            <a href="{{ route('admin::panel::pages::index') }}" class="btn btn-block btn-primary">Volver al listado</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop