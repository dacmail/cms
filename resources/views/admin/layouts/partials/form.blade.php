<div class="form-body">
    {{ csrf_field() }}
    @foreach ($formFields as $field => $type)
        @if ($type['field'] == 'text' || $type['field'] == 'email' || $type['field'] == 'date')
            <div class="form-group {{ $errors->has($field) ? 'has-error' : '' }}">
                <label class="control-label col-md-3">{{ isset($type['required']) ? '*' : '' }} {{ ucfirst(trans('validation.attributes.' . $field)) }}</label>
                <div class="col-md-9">
                    <input type="{{ $type['field'] }}" name="{{ $field }}" class="form-control" value="{{ is_null($model) ? '' : $model->$field }}" />
                    {!! ! $errors->has($field) && isset($type['help']) ? '<span class="help-block">' . $type['help'] . '</span>' : '' !!}
                    {!! $errors->first($field, '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        @elseif ($type['field'] == 'password')
            <div class="form-group {{ $errors->has($field) ? 'has-error' : '' }}">
                <label class="control-label col-md-3">{{ isset($type['required']) ? '*' : '' }} {{ ucfirst(trans('validation.attributes.' . $field)) }}</label>
                <div class="col-md-9">
                    <input type="password" name="{{ $field }}" class="form-control" />
                    {!! ! $errors->has($field) && isset($type['help']) ? '<span class="help-block">' . $type['help'] . '</span>' : '' !!}
                    {!! $errors->first($field, '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        @elseif($type['field'] == 'select')
            <div class="form-group {{ $errors->has($field) ? 'has-error' : '' }}">
                <label class="control-label col-md-3">{{ isset($type['required']) ? '*' : '' }} {{ ucfirst(trans('validation.attributes.' . $field)) }}</label>
                <div class="col-md-9">
                    <select name="{{ $field }}" class="form-control" {{ isset($type['required']) ? 'required' : '' }}>
                        @foreach(config('protecms.'.$configfile.'.' . $field) as $modeltype)
                            <option value="{{ $modeltype }}" {{ is_null($model) ? '' : $model->$field == $modeltype ? 'selected' : '' }}>{{ trans($langfile . '.'. $field .'.' . $modeltype) }}</option>
                        @endforeach
                    </select>
                    {!! ! $errors->has($field) && isset($type['help']) ? '<span class="help-block">' . $type['help'] . '</span>' : '' !!}
                    {!! $errors->first($field, '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        @endif
    @endforeach
</div>
<div class="form-actions">
    <div class="row">
        <div class="col-md-offset-5 col-md-2">
            <input type="submit" class="btn btn-block btn-primary" value="{{ $textSubmit }}">
        </div>
    </div>
</div>