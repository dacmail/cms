@if ($langform !== config('app.locale'))
    <a class="btn btn-default collapse-control-translation" role="button" data-toggle="collapse" href="#translation-{{ $field }}" aria-expanded="false" aria-controls="translation">
        Ver traducción principal
    </a>
    <div id="translation-{{ $field }}" class="collapse collapse-translation">{!! $model->hasTranslation(config('app.locale')) ? $model->translate(config('app.locale'))->$field : '' !!}</div>
@endif