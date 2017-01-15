@extends('admin.layouts.base')

@section('page.title')
    Listado de animales eliminados
    <small><br>(Las fichas de los animales se eliminarán de forma permanente 30 días después de su eliminación)</small>
    <div class="pull-right"><small>Mostrando {{ $animals->count() }} animales de un total de {{ $total }}.</small></div>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::animals::index') }}">Animales</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::animals::create') }}">Eliminados</a>
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
                                <a href="{{ route('admin::panel::animals::restore', ['id' => $animal->id]) }}" class="btn btn-primary btn-block confirm">
                                    <i class="fa fa-history"></i>
                                </a>
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
    <p>Esta página muestra el listado de animales eliminados de la protectora.</p>
    <p>Se pueden ordenar por nombre y edad (también a la inversa) y se pueden filtrar por nombre, estado, especie, género y edad.</p>
    <p>Haciendo clic en el siguiente botón se recuperará la ficha del animal y aparecerá en el listado de animales.</p>
    <p><button class="btn btn-primary"><i class="fa fa-history"></i></button></p>
    <p class="bg-info">Los animales que permanezcan más de 30 días eliminados, se eliminarán de forma permanente.</p>
@stop