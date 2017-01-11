@extends('admin.layouts.base')

@section('page.title')
    Ficha de {{ $animal->name }}
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
        <a href="{{ route('admin::panel::animals::health::index', ['id' => $animal->id]) }}">Salud</a>
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
                        <option value="-created_at" {{ $request->get('sort') == '-created_at' ? 'selected' : '' }}>Fecha de creación</option>
                        <option value="-start_date" {{ $request->get('sort') == '-start_date' ? 'selected' : '' }}>Fecha de inicio</option>
                        <option value="start_date" {{ $request->get('sort') == 'start_date' ? 'selected' : '' }}>Fecha de inicio (inversa)</option>
                        <option value="-end_date" {{ $request->get('sort') == '-end_date' ? 'selected' : '' }}>Fecha de fin</option>
                        <option value="end_date" {{ $request->get('sort') == 'end_date' ? 'selected' : '' }}>Fecha de fin (inversa)</option>
                        <option value="title" {{ $request->get('sort') == 'title' ? 'selected' : '' }}>Título</option>
                        <option value="-title" {{ $request->get('sort') == '-title' ? 'selected' : '' }}>Título (inversa)</option>
                        
                    </select>
                </div>
                <div class="table-scrollable">
                    <table class="table-center table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Título</th>
                            <th>Tipo</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de fin</th>
                            <th>Coste</th>
                            <th>Acciones</th>
                        </tr>
                        <tr class="help-step-2">
                            <th><input type="text" name="title" class="form-control" placeholder="Título..." value="{{ $request->get('title') }}"></th>
                            <th>
                                <select name="type" class="form-control" placeholder="Tipo...">
                                    <option value="">-- Seleccione --</option>
                                    @foreach(config('protecms.animals.health.type') as $type)
                                        <option value="{{ $type }}" {{ $request->get('type') == $type ? 'selected' : '' }}>{{ trans('animals.health.type.' . $type) }}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th>
                                
                            </th>
                            <th>
                                
                            </th>
                            <th>
                                <input type="number" name="cost" class="form-control" placeholder="Coste..." value="{{ $request->get('cost') }}">
                            </th>
                            <th class="help-step-3">
                                <button type="submit" class="btn btn-block btn-primary">Filtrar</button>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (count($health))
                            @foreach ($health as $h)
                                <tr>
                                    <td>{{ $h->title }}</td>
                                    <td>
                                        {{ trans('animals.health.type.' . $h->type) }}

                                        @if ($h->type == 'treatment')
                                            <i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-trigger="hover" title="{{ $h->title }}" data-content="
                                            Fecha inicio: {{ $h->start_date ? $h->start_date->format('d-m-Y') : '-' }}<br>
                                            Fecha fin: {{ $h->end_date ? $h->end_date->format('d-m-Y') : '-' }}<br>
                                            Coste: {{ $h->cost ? $h->cost.'€' : '-' }}<br>
                                            @if ($h->type == 'treatment' && $h->medicine)
                                                Medicina: {{ $h->medicine }}<br>
                                            @endif
                                            Número de tratamientos: {{ $h->treatments_number or '-' }}<br>
                                            Aplicar cada: {{ $h->treatments_each or '-' }} {{ trans('animals.health.treatments.time.' . $h->treatments_time) }}<br>
                                            "></i>
                                        @elseif ($h->type == 'test')
                                            <i class="fa fa-info-circle" data-toggle="popover" data-placement="top" data-trigger="hover" title="{{ $h->title }}" data-content="
                                            Resultado de la prueba: <br>{{ trans('animals.health.test.' . $h->test_result) }}<br>
                                            "></i>
                                        @endif
                                    </td>
                                    <td>{{ $h->start_date ? $h->start_date->format('d-m-Y') : '-' }}</td>
                                    <td>{{ $h->end_date ? $h->end_date->format('d-m-Y') : '-' }}</td>
                                    <td>{{ $h->cost ? $h->cost.'€' : '-' }}</td>

                                    <td class="table-actions">
                                        <div class="col-md-6 col-xs-6">
                                            <a href="{{ route('admin::panel::animals::health::edit', ['animal_id' => $animal->id, 'id' => $h->id]) }}" class="btn btn-primary btn-block">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-xs-6">
                                            <a href="{{ route('admin::panel::animals::health::delete', ['animal_id' => $animal->id, 'id' => $h->id]) }}" class="btn btn-danger btn-block confirm">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">No existen registros de la salud de {{ $animal->name }} con esos parámetros.</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </form>

            {!! $health->appends($request->all())->links() !!}
        </div>
    </div>
@stop