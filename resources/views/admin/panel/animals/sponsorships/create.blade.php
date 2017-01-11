@extends('admin.layouts.base')

@section('page.title')
    Añadir apadrinamiento a la ficha de {{ $animal->name }}
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
        <a href="{{ route('admin::panel::animals::sponsorships::index', ['id' => $animal->id]) }}">Apadrinamientos</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::animals::sponsorships::create', ['animal_id' => $animal->id]) }}">Añadir apadrinamiento</a>
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
            <div class="portlet light bordered form-fit">
                <div class="portlet-body form">
                    <form action="{{ route('admin::panel::animals::sponsorships::store', ['animal_id' => $animal->id]) }}" method="POST" class="form-horizontal form-bordered form-label-stripped">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.name')) }}</label>
                            <div class="col-md-10">
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                                {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.email')) }}</label>
                            <div class="col-md-10">
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.phone')) }}</label>
                            <div class="col-md-10">
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                                {!! $errors->first('phone', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.address')) }}</label>
                            <div class="col-md-10">
                                <input type="text" name="address" value="{{ old('address') }}" class="form-control">
                                {!! $errors->first('address', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        @include('admin.layouts.partials.location')
                        <div class="form-group {{ $errors->has('visible') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* Visible en la web</label>
                            <div class="col-md-10">
                                <select name="visible" class="form-control">
                                    @foreach(config('protecms.animals.sponsorships.visible') as $visible)
                                        <option value="{{ $visible }}">{{ trans('animals.sponsorships.visible.' . $visible) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('visible', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.status')) }}</label>
                            <div class="col-md-10">
                                <select name="status" class="form-control">
                                    @foreach(config('protecms.animals.sponsorships.status') as $status)
                                        <option value="{{ $status }}">{{ trans('animals.sponsorships.status.' . $status) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('status', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.start_date')) }}</label>
                            <div class="col-md-10">
                                <input type="text" name="start_date" value="{{ old('start_date') }}" class="form-control datetime-not-inline">
                                {!! $errors->first('start_date', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.end_date')) }}</label>
                            <div class="col-md-10">
                                <input type="text" name="end_date" value="{{ old('end_date') }}" class="form-control datetime-not-inline">
                                {!! $errors->first('end_date', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('donation') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.donation')) }}</label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <input type="number" name="donation" value="{{ old('donation') }}" class="form-control">
                                    <span class="input-group-addon" id="basic-addon2">€</span>
                                </div>
                                {!! $errors->first('donation', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('payment_method') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.payment_method')) }}</label>
                            <div class="col-md-10">
                                <select name="payment_method" class="form-control">
                                    @foreach(config('protecms.animals.sponsorships.payment_method') as $payment_method)
                                        <option value="{{ $payment_method }}" {{ old('payment_method') == $payment_method ? 'selected' : '' }}>{{ trans('animals.sponsorships.payment_method.' . $payment_method) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('payment_method', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('donation_time') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">* {{ ucfirst(trans('validation.attributes.donation_time')) }}</label>
                            <div class="col-md-10">
                                <select name="donation_time" class="form-control">
                                    @foreach(config('protecms.animals.sponsorships.donation_time') as $donation_time)
                                        <option value="{{ $donation_time }}" {{ old('donation_time') == $donation_time ? 'selected' : '' }}>{{ trans('animals.sponsorships.donation_time.' . $donation_time) }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('donation_time', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('text') ? 'has-error' : '' }}">
                            <label class="control-label col-md-2">{{ ucfirst(trans('validation.attributes.observations')) }}</label>
                            <div class="col-md-10">
                                <textarea name="text" class="form-control tinymce">{{ old('text') }}</textarea>
                                {!! $errors->first('text"', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-4">
                                    <input type="submit" class="btn btn-block btn-primary" value="Añadir">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop