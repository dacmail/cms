@extends('admin.layouts.base')

@section('page.title')
    Estadísticas de las finanzas
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::finances::index') }}">Finanzas</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{{ route('admin::finances::stats') }}">Estadísticas</a>
    </li>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div id="finances-chart"></div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>

    $('#finances-chart').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Finanzas'
        },
        xAxis: {
            categories: [
                'Oct', 'Nov', 'Dic', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul'
            ]
        },
        yAxis: {
            title: {
                text: "Euros (€)"  
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Ingresos',
            data: [5, 3, 4, 7, 2, 4, 6, 1, 10, 4]
        }, {
            name: 'Gastos',
            data: [-2, -2, -3, -2, -1, -5, -10, -6, -7, -9]
        }]
    });

</script>
@endpush