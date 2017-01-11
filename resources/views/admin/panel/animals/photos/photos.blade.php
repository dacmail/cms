@extends('admin.layouts.base')

@section('page.title')
    Fotos de {{ $animal->name }}
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::animals::index') }}">Animales</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::animals::edit', ['id' => $animal->id]) }}">{{ $animal->name }}</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::animals::photos::index', ['id' => $animal->id]) }}">Fotos</a>
    </li>
@stop

@section('content')
    <div class="row">
        <div class="col-md-2 animal-menu">
            @include('admin.layouts.partials.animalmenu', [
                'animal' => $animal
            ])
        </div>
        <div class="col-md-10">
            <form action="{{ route('admin::panel::animals::photos::store', ['id' => $animal->id]) }}" class="dropzone" id="animalsDropzone">
                {{ csrf_field() }}
                <div class="dz-message">
                    Arrastre o haga clic aquí para seleccionar las fotos a subir<br>
                    <small>Puede seleccionar o arrastrar varias a la vez</small>
                </div>
                <div id="dz-preview" class="dz-preview dz-file-preview">
                    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <hr>
            <div class="photos-gallery" style="padding-left: 0;padding-right: 0">
                @if (count($animal->media))
                    @foreach ($animal->photos as $photo)
                        <div class="photo col-lg-2 col-sm-3">
                            <div class="thumbnail">
                                <a href="{{ route('animals::photo', ['id' => $animal->id, 'photo' => $photo->file]) }}"><img src="{{ $photo->thumbnail_url }}" class="img-responsive" alt=""></a>
                                <div class="caption">
                                        <a href="{{ route('admin::panel::animals::photos::main', ['animal_id' => $animal->id, 'id' => $photo->id]) }}" class="btn btn-primary btn-md {{ $photo->isMain() ? 'invisible' : '' }}" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Seleccionar foto como principal"><i class="fa fa-file-image-o"></i></a>
                                    <a href="{{ route('admin::panel::animals::photos::delete', ['animal_id' => $animal->id, 'id' => $photo->id]) }}" class="btn btn-danger pull-right btn-md confirm" title="Eliminar foto"><i class="fa fa-trash"></i></a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-4 col-md-offset-4 animal-not-photos">
                        <div class="alert alert-info text-center">
                            No existen fotos de {{ $animal->name }}.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop