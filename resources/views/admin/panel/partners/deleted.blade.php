@extends('admin.layouts.base')

@section('page.title')
    Listado de socios eliminados
    <small><br>(Los socios se eliminarán de forma permanente 30 días después de su eliminación)</small>
    <div class="pull-right"><small>Mostrando {{ $partners->count() }} socios de un total de {{ $total }}.</small></div>
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::partners::index') }}">Socios</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::panel::partners::deleted') }}">Eliminados</a>
    </li>
@stop

@section('content')
    <form action="" method="GET">
        <div class="pull-right">
            Ordenar por <select name="sort" class="margin-bottom-20" onchange="this.form.submit()">
                <option value="name" {{ $request->get('sort') == 'name' ? 'selected' : '' }}>Nombre</option>
                
                <option value="email" {{ $request->get('sort') == 'email' ? 'selected' : '' }}>Correo electrónico</option>
            </select>
        </div>
        <div class="table-scrollable">
            <table class="table table-center table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo electrónico</th>
                        <th>Donación
                            <span data-toggle="popover" data-placement="top" data-trigger="hover" data-content="Puede filtrar varias cantidades separándolas por coma. Ej: 6,12,20">
                                <i class="fa fa-info-circle"></i>
                            </span>
                        </th>
                        <th>Cuota</th>
                        <th>Tiempo</th>
                        <th>Acciones</th>
                    </tr>
                    <tr>
                        <th><input type="text" name="name" class="form-control" placeholder="Nombre..." value="{{ $request->get('name') }}"></th>
                        <th><input type="text" name="email" class="form-control" placeholder="Correo electrónico..." value="{{ $request->get('email') }}"></th>
                        <th><input type="numer" name="donation" class="form-control" placeholder="Donación..." value="{{ $request->get('donation') }}"></th>
                        <th>
                            <select name="donation_time" class="form-control">
                                <option value="">-- Seleccione --</option>
                                @foreach(config('protecms.partners.donation_time') as $donation_time)
                                    <option value="{{ $donation_time }}" {{ $request->get('donation_time') == $donation_time ? 'selected' : '' }}>{{ trans('partners.donation_time.' . $donation_time) }}</option>
                                @endforeach
                            </select>
                        </th>
                        <th>
                            <input type="text" class="form-control" disabled>
                        </th>
                        <th>
                            <button type="submit" class="btn btn-block btn-primary">Filtrar</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                @if (count($partners))
                    @foreach ($partners as $partner)
                        <tr>
                            <td>{{ $partner->name or '-' }}</td>
                            <td>{{ $partner->email or '-' }}</td>
                            <td>{{ $partner->donation or '-' }}€</td>
                            <td>{{ trans('partners.donation_time.' . $partner->donation_time) }}</td>
                            <td>
                                @if (! $partner->end_date && $partner->start_date)
                                    Socio hace {{ $partner->start_date ? Carbon::now()->diffInMonths($partner->start_date): '-' }} mes/es
                                @elseif ($partner->start_date)
                                    Fue socio {{ $partner->start_date->diffInMonths($partner->end_date) }} mes/es
                                @else
                                    -
                                @endif
                            </td>
                            <td class="table-actions">
                                <a href="{{ route('admin::panel::partners::restore', ['id' => $partner->id]) }}" class="btn btn-primary btn-block confirm">
                                    <i class="fa fa-history"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">
                            @if ($total)
                                No existen socios con esos parámetros.
                            @else
                                <p class="bg-info text-center">No existen socios eliminados.</p>
                            @endif
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </form>

    {!! $partners->appends($request->all())->links() !!}
@stop

@section('page.help.text')
    <p>Esta página muestra el listado de socios eliminados de la protectora.</p>
    <p>Se pueden ordenar por nombre y correo electrónico y se pueden filtrar por nombre, correo electrónico, donación y cuota.</p>
    <p>Haciendo clic en el siguiente botón se recuperará el socio y aparecerá en el listado de socios.</p>
    <p><button class="btn btn-primary"><i class="fa fa-history"></i></button></p>
    <p class="bg-info">Los socios que permanezcan más de 30 días eliminados, se eliminarán de forma permanente.</p>
@stop