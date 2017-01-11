@extends('admin.layouts.base')

@section('page.title')
    Apadrinamientos de {{ $animal->name }}
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
            <form action="" method="GET">
                <div class="pull-right">
                    Ordenar por <select name="sort" class="margin-bottom-20" onchange="this.form.submit()">
                        <option value="name" {{ $request->get('sort') == 'name' ? 'selected' : '' }}>Nombre</option>
                        <option value="-name" {{ $request->get('sort') == '-name' ? 'selected' : '' }}>Nombre (inversa)</option>
                        <option value="-created_at" {{ $request->get('sort') == '-created_at' ? 'selected' : '' }}>Fecha de creación</option>
                        <option value="-start_date" {{ $request->get('sort') == '-start_date' ? 'selected' : '' }}>Fecha de inicio</option>
                        <option value="start_date" {{ $request->get('sort') == 'start_date' ? 'selected' : '' }}>Fecha de inicio (inversa)</option>
                        <option value="end_date" {{ $request->get('sort') == 'end_date' ? 'selected' : '' }}>Fecha de fin (inversa)</option>
                        <option value="-end_date" {{ $request->get('sort') == '-end_date' ? 'selected' : '' }}>Fecha de fin</option>

                    </select>
                </div>
                <div class="table-scrollable">
                    <table class="table-center table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo electrónico</th>
                            <th>Donación</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                        <tr class="help-step-2">
                            <th><input type="text" name="name" class="form-control" placeholder="Nombre..." value="{{ $request->get('name') }}"></th>
                            <th><input type="text" name="email" class="form-control" placeholder="Correo electrónico..." value="{{ $request->get('email') }}"></th>
                            <th><input type="text" name="donation" class="form-control" placeholder="Donación..." value="{{ $request->get('donation') }}"></th>
                            <th>
                                <select name="status" class="form-control">
                                    <option value="">-- Seleccione --</option>
                                    @foreach(config('protecms.animals.sponsorships.status') as $status)
                                        <option value="{{ $status }}" {{ $request->get('status') == $status ? 'selected' : '' }}>{{ trans('animals.sponsorships.status.' . $status) }}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th class="help-step-3">
                                <button type="submit" class="btn btn-block btn-primary">Filtrar</button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($sponsorships))
                            @foreach ($sponsorships as $sponsorship)
                                <tr>
                                    <td>{{ $sponsorship->name }}</td>
                                    <td>{{ $sponsorship->email or '-' }}</td>
                                    <td>{{ $sponsorship->donation ? $sponsorship->donation.'€' : '-' }}</td>
                                    <td>{{ trans('animals.sponsorships.status.' . $sponsorship->status) }}</td>
                                    <td class="table-actions">
                                        <div class="col-md-6 col-xs-6">
                                            <a href="{{ route('admin::panel::animals::sponsorships::edit', ['animal_id' => $animal->id, 'id' => $sponsorship->id]) }}" class="btn btn-primary btn-block">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <a href="{{ route('admin::panel::animals::sponsorships::delete', ['animal_id' => $animal->id, 'id' => $sponsorship->id]) }}" class="btn btn-danger btn-block confirm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">No existen registros de padrinos de {{ $animal->name }} con esos parámetros.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </form>

            {!! $sponsorships->appends($request->all())->links() !!}
        </div>
    </div>
@stop