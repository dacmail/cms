@if (count(explode(',', $web->getConfig('langs'))) > 1)
<div class="col-md-3 pull-right margin-bottom-20">
    <form>
        Cambiar traducción 
        <select name="langform" class="form-control" onchange="this.form.submit()">
            @foreach(explode(',', $web->getConfig('langs')) as $key => $lang)

                @if (! isset($route) && ! $model->hasTranslation($lang))
                    @continue
                @endif

                <option value="{{ $lang }}" {{ Request::has('langform') && $lang == Request::get('langform') ? 'selected' : $lang == config('app.locale') ? 'selected' : '' }}>
                    {{ trans('app.languages.' . $lang) }} {{ $lang == config('app.locale') ? '(Principal)' : '' }} {{ ! $model->hasTranslation($lang) ? '(Sin traducción)' : '' }}
                </option>
            @endforeach
        </select>
    </form>
    @if (isset($route) && $web->lang !== $langform && $model->hasTranslation($lang))
        <a href="{{ $route }}?langform={{ $lang }}" class="margin-top-10 btn btn-danger btn-block confirm"><i class="fa fa-trash"></i> Eliminar traducción</a>
    @endif
</div>
<div class="clearfix"></div>
@endif