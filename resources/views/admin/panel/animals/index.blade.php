@extends('admin.layouts.base')

@section('page.title')
    Listado de animales <div class="pull-right"><small>Mostrando {{ $animals->count() }} animales de un total de {{ $total }}.</small></div>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::animals::index') }}">Animales</a>
    </li>
@stop

@section('content')
    <form action="" method="GET">
        <div class="pull-right">
            Ordenar por <select name="sort" class="margin-bottom-20" onchange="this.form.submit()">
                <option value="name" {{ $request->get('sort') == 'name' ? 'selected' : '' }}>Nombre</option>
                <option value="-name" {{ $request->get('sort') == '-name' ? 'selected' : '' }}>Nombre (inversa)</option>
                <option value="birth_date" {{ $request->get('sort') == 'birth_date' ? 'selected' : '' }}>Edad (Mayor a menor)</option>
                <option value="-birth_date" {{ $request->get('sort') == '-birth_date' ? 'selected' : '' }}>Edad (Menor a mayor)</option>
                
            </select>
        </div>
        <div class="table-scrollable">
            <table class="table-animals table table-center table-striped table-condensed table-bordered table-hover">
                <thead>
                <tr>
                    <th class="table-row-image">Foto</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Especie</th>
                    <th>Género</th>
                    <th>Edad</th>
                    <th>Acciones</th>
                </tr>
                <tr>
                    <th class="table-row-image"></th>
                    <th><input type="text" name="name" class="form-control" placeholder="Nombre..." value="{{ $request->get('name') }}"></th>
                    <th>
                        <select name="status" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach(config('protecms.animals.status') as $status)
                                <option value="{{ $status }}" {{ $request->get('status') == $status ? 'selected' : '' }}>{{ trans_choice('animals.status.' . $status, 1) }}</option>
                            @endforeach
                        </select>
                    </th>
                    <th>
                        <select name="kind" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach(config('protecms.animals.kind') as $kind)

                                @if (! Auth::user()->hasPermissions(['admin.panel.animals.' . $kind, 'admin.panel.animals.' . $kind. '.view']))
                                    @continue
                                @endif

                                <option value="{{ $kind }}" {{ $request->get('kind') == $kind ? 'selected' : '' }}>{{ trans_choice('animals.kind.' . $kind, 1) }}</option>
                            @endforeach
                        </select>
                    </th>
                    <th>
                        <select name="gender" class="form-control">
                            <option value="">-- Seleccione --</option>
                            @foreach(config('protecms.animals.gender') as $gender)
                                <option value="{{ $gender }}" {{ $request->get('gender') == $gender ? 'selected' : '' }}>{{ trans_choice('animals.gender.' . $gender, 1) }}</option>
                            @endforeach
                        </select>
                    </th>
                    {{--<th><input type="text" name="birth_date" class="form-control datetimerange" placeholder="Fecha de nacimiento..." value="{{ $request->get('birth_date') }}"></th>--}}
                    <th>
                        <select name="birth_date" class="form-control">
                            <option value="">-- Seleccione --</option>
                            <option value="{{ Carbon::now()->subMonths(6)->format('Y/m/d') . ' - ' . Carbon::now()->format('Y/m/d') }}" {{ $request->get('birth_date') == Carbon::now()->subMonths(6)->format('Y/m/d') . ' - ' . Carbon::now()->format('Y/m/d') ? 'selected' : '' }}>< 6 meses</option>
                            <option value="{{ Carbon::now()->subMonths(12)->format('Y/m/d') . ' - ' . Carbon::now()->subMonths(6)->format('Y/m/d') }}" {{ $request->get('birth_date') == Carbon::now()->subMonths(12)->format('Y/m/d') . ' - ' . Carbon::now()->subMonths(6)->format('Y/m/d') ? 'selected' : '' }}>De 6 a 12 meses</option>
                            <option value="{{ Carbon::now()->subYears(3)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(1)->format('Y/m/d') }}" {{ $request->get('birth_date') == Carbon::now()->subYears(3)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(1)->format('Y/m/d') ? 'selected' : '' }}>De 1 a 3 años</option>
                            <option value="{{ Carbon::now()->subYears(5)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(3)->format('Y/m/d') }}" {{ $request->get('birth_date') == Carbon::now()->subYears(5)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(3)->format('Y/m/d') ? 'selected' : '' }}>De 3 a 5 años</option>
                            <option value="{{ Carbon::now()->subYears(7)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(5)->format('Y/m/d') }}" {{ $request->get('birth_date') == Carbon::now()->subYears(7)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(5)->format('Y/m/d') ? 'selected' : '' }}>De 5 a 7 años</option>
                            <option value="{{ Carbon::now()->subYears(10)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(7)->format('Y/m/d') }}" {{ $request->get('birth_date') == Carbon::now()->subYears(10)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(7)->format('Y/m/d') ? 'selected' : '' }}>De 7 a 10 años</option>
                            <option value="{{ Carbon::now()->subYears(1000)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(10)->format('Y/m/d') }}" {{ $request->get('birth_date') == Carbon::now()->subYears(1000)->format('Y/m/d') . ' - ' . Carbon::now()->subYears(10)->format('Y/m/d') ? 'selected' : '' }}> > 10 años</option>
                        </select>
                    </th>
                    <th>
                        <button type="submit" class="btn btn-block btn-primary">Filtrar</button>
                    </th>
                </tr>
                </thead>
                <tbody>
                @if (count($animals))
                    @foreach ($animals as $animal)
                        <tr>
                            <td class="table-animals-photo table-row-image">
                                <img src="{{ $animal->photos[0]->thumbnail_url or Theme::url('images/animal-default.jpg') }}" class="img-responsive">
                            </td>
                            <td>{{ $animal->name }}</td>
                            <td>{{ trans_choice('animals.status.' . $animal->status, 1) }}</td>
                            <td>{{ trans_choice('animals.kind.' . $animal->kind, 1) }}</td>
                            <td>{{ trans_choice('animals.gender.' . $animal->gender, 1) }}</td>
                            <td>
                                <span data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ $animal->birth_date->format('d-m-Y') }}">
                                    {{ $animal->birthDateDiffForHumans() }}
                                </span>
                            </td>
                            <td class="table-actions">
                                @if (! Auth::user()->isAdmin() && Auth::user()->hasPermission('admin.panel.animals.' . $animal->kind. '.view'))
                                    <div class="col-md-offset-3 col-md-6 col-xs-12">
                                        <a href="{{ route('admin::panel::animals::show', ['id' => $animal->id]) }}" class="btn btn-primary btn-block">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                @else
                                    <div class="col-md-6 col-xs-6">
                                        <a href="{{ route('admin::panel::animals::edit', ['id' => $animal->id]) }}" class="btn btn-primary btn-block">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <a href="{{ route('admin::panel::animals::delete', ['id' => $animal->id]) }}" class="btn btn-danger btn-block confirm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" class="text-center">
                            @if ($total)
                                No existen animales con esos parámetros.
                            @else
                                <p class="bg-info text-center">Aún no se ha creado la ficha de ningún animal.</p>
                            @endif
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </form>

    {!! $animals->appends($request->all())->links() !!}
@stop

@section('page.help.text')
    <p>Esta página muestra el listado de animales de la protectora.</p>
    <p>Se pueden ordenar por nombre y edad (también a la inversa) y se pueden filtrar por nombre, estado, especie, género y edad.</p>

    <h4>Permisos</h4>
    <p>En esta página existen dos tipos de permisos: El voluntario puede editar y eliminar una ficha o solo puede verla.</p>
    <p class="bg-info">Si el voluntario solo tiene acceso a determinadas especies, solo verá estas en el listado, las demás no aparecerán.</p>
    <p>Si ve estos botones es que tiene acceso a editar y eliminar la ficha del animal.</p>
    <p>
        <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
    </p>
    <p>Sin embargo si solo ve este botón, es que solo tiene permisos para ver la ficha y no para actualizarla o eliminarla.</p>
    <p><button class="btn btn-primary"><i class="fa fa-eye"></i></button></p>
@stop