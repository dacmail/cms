@if ($langform == config('app.locale'))
    Editar:
@else
    @if ($model->hasTranslation($langform))
        Editar traducción en {{ strtolower(trans('app.languages.' . $langform)) }} de:
    @else
        Publicar traducción en {{ strtolower(trans('app.languages.' . $langform)) }} de:
    @endif
@endif