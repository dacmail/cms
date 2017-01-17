@extends('admin.layouts.base')

@section('page.title')
    Estadísticas de la protectora
@stop

@section('breadcrumb')
    <li>
        <a href="{{ route('admin::panel::stats') }}">Estadísticas</a>
    </li>
@stop

@section('content')
<div class="row">
     <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue bold uppercase">Visitas y visualizaciones</span>
                </div>
            </div>
            <div class="portlet-body">
                <div id="analytics-chart" style="width: 100%; height: 400px"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-blue bold uppercase">Estadísticas generales</span>
                </div>
            </div>
            <div class="portlet-body">
                <div id="stats" style="width: 100%; height: 400px; overflow: scroll">
                    <div class="col-md-6">
                        <h4>Animales</h4>
                        <table class="table table-striped">
                            <tr>
                                <td>Animales</td>
                                <td class="text-right">{{ $data['animals_total'] }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Por estado</strong></td>
                            </tr>
                            <tr>
                                <td>En adopción</td>
                                <td class="text-right">{{ $data['animals_adoption'] }}</td>
                            </tr>
                            <tr>
                                <td>Adoptados</td>
                                <td class="text-right">{{ $data['animals_adopted'] }}</td>
                            </tr>
                            <tr>
                                <td>Reservados</td>
                                <td class="text-right">{{ $data['animals_reserved'] }}</td>
                            </tr>
                            <tr>
                                <td>No disponibles</td>
                                <td class="text-right">{{ $data['animals_unavailable'] }}</td>
                            </tr>
                            <tr>
                                <td>Perdidos</td>
                                <td class="text-right">{{ $data['animals_lost'] }}</td>
                            </tr>
                            <tr>
                                <td>Encontrados</td>
                                <td class="text-right">{{ $data['animals_found'] }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Por género</strong></td>
                            </tr>
                            <tr>
                                <td>Machos</td>
                                <td class="text-right">{{ $data['animals_male'] }}</td>
                            </tr>
                            <tr>
                                <td>Hembras</td>
                                <td class="text-right">{{ $data['animals_female'] }}</td>
                            </tr>
                            <tr>
                                <td>Desconocidos</td>
                                <td class="text-right">{{ $data['animals_unknown'] }}</td>
                            </tr>
                            <tr>
                                <td colspan="2"><strong>Por localización</strong></td>
                            </tr>
                            <tr>
                                <td>En la protectora</td>
                                <td class="text-right">{{ $data['animals_shelter'] }}</td>
                            </tr>
                            <tr>
                                <td>En casa de acogida</td>
                                <td class="text-right">{{ $data['animals_temporary_home'] }}</td>
                            </tr>
                            <tr>
                                <td>En residencias</td>
                                <td class="text-right">{{ $data['animals_animal_home'] }}</td>
                            </tr>
                            <tr>
                                <td>En la calle</td>
                                <td class="text-right">{{ $data['animals_street'] }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h4>Usuarios</h4>
                        <table class="table table-striped">
                            <tr>
                                <td>Usuarios</td>
                                <td class="text-right">{{ $data['users'] }}</td>
                            </tr>
                            <tr>
                                <td>Voluntarios</td>
                                <td class="text-right">{{ $data['volunteers'] }}</td>
                            </tr>
                            <tr>
                                <td>Administradores</td>
                                <td class="text-right">{{ $data['admins'] }}</td>
                            </tr>
                        </table>
                        <h4>Socios</h4>
                        <table class="table table-striped">
                            <tr>
                                <td>Socios</td>
                                <td class="text-right">{{ $data['partners'] }}</td>
                            </tr>
                        </table>
                        <h4>Artículos</h4>
                        <table class="table table-striped">
                            <tr>
                                <td>Artículos</td>
                                <td class="text-right">{{ $data['posts'] }}</td>
                            </tr>
                        </table>
                        <h4>Otras estadísticas</h4>
                        <table class="table table-striped">
                            <tr>
                                <td>Páginas</td>
                                <td class="text-right">{{ $data['pages'] }}</td>
                            </tr>
                            <tr>
                                <td>Formularios</td>
                                <td class="text-right">{{ $data['forms'] }}</td>
                            </tr>
                            <tr>
                                <td>Veterinarios</td>
                                <td class="text-right">{{ $data['veterinarians'] }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div id="animals-kind-chart"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div id="animals-status-chart"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div id="animals-gender-chart"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-body">
                <div id="animals-location-chart"></div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
    $('#analytics-chart').highcharts({
        chart: {
            type: 'area'
        },
        title: {
            text: 'Visitas y visualizaciones'
        },
        xAxis: {
            categories: [
                @foreach ($data['analytics']['categories'] as $category)
                    '{{ date('d-m-Y', strtotime($category)) }}',
                @endforeach
            ],
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: 'Estadísticas'
            }
        },
        plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: [
            {
                name: 'Páginas vistas',
                data: [
                    @foreach($data['analytics']['pageviews'] as $pageview)
                        {{ $pageview }},
                    @endforeach
                ]
            },
            {
                name: 'Visitas',
                data: [
                    @foreach($data['analytics']['users'] as $users)
                        {{ $users }},
                    @endforeach
                ]
            }
        ]
    });

    $('#animals-gender-chart').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Animales por género'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: "Animales",
            colorByPoint: true,
            data: [
            {
                name: "{{ trans_choice('animals.gender.male', 1) }}",
                y: {{ str_replace(',', '.', $data['animals_male'] * $data['animals_total'] / 100) }}
            }, {
                name: "{{ trans_choice('animals.gender.female', 1) }}",
                y: {{ str_replace(',', '.', $data['animals_female'] * $data['animals_total'] / 100) }}
            }, {
                name: "{{ trans_choice('animals.gender.unknown', 1) }}",
                y: {{ str_replace(',', '.', $data['animals_unknown'] * $data['animals_total'] / 100) }}
            }
            ]
        }]
    });

    $('#animals-status-chart').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Animales por estado'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: "Animales",
            colorByPoint: true,
            data: [
            {
                name: "{{ trans_choice('animals.status.adoption', 1) }}",
                y: {{ str_replace(',', '.', $data['animals_adoption'] * $data['animals_total'] / 100) }}
            }, {
                name: "{{ trans_choice('animals.status.reserved', 1) }}",
                y: {{ str_replace(',', '.', $data['animals_reserved'] * $data['animals_total'] / 100) }}
            }, {
                name: "{{ trans_choice('animals.status.unavailable', 1) }}",
                y: {{ str_replace(',', '.', $data['animals_unavailable'] * $data['animals_total'] / 100) }}
            }, {
                name: "{{ trans_choice('animals.status.found', 1) }}",
                y: {{ str_replace(',', '.', $data['animals_found'] * $data['animals_total'] / 100) }}
            }, {
                name: "{{ trans_choice('animals.status.lost', 1) }}",
                y: {{ str_replace(',', '.', $data['animals_lost'] * $data['animals_total'] / 100) }}
            }
            ]
        }]
    });

    $('#animals-location-chart').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Animales por localización'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: "Animales",
            colorByPoint: true,
            data: [
            {
                name: "{{ trans('animals.location.shelter') }}",
                y: {{ str_replace(',', '.', $data['animals_shelter'] * $data['animals_total'] / 100) }}
            }, {
                name: "{{ trans('animals.location.temporary_home') }}",
                y: {{ str_replace(',', '.', $data['animals_temporary_home'] * $data['animals_total'] / 100) }}
            }, {
                name: "{{ trans('animals.location.animal_home') }}",
                y: {{ str_replace(',', '.', $data['animals_animal_home'] * $data['animals_total'] / 100) }}
            }, {
                name: "{{ trans('animals.location.street') }}",
                y: {{ str_replace(',', '.', $data['animals_street'] * $data['animals_total'] / 100) }}
            }, {
                name: "{{ trans('animals.location.unknown') }}",
                y: {{ str_replace(',', '.', $data['animals_unknown'] * $data['animals_total'] / 100) }}
            }
            ]
        }]
    });

    $('#animals-kind-chart').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Animales por especie'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: "Animales",
            colorByPoint: true,
            data: [
            {
                name: "{{ trans_choice('animals.kind.dog', 1) }}",
                y: {{ str_replace(',', '.', $data['animals_dog'] * $data['animals_total'] / 100) }}
            }, {
                name: "{{ trans_choice('animals.kind.cat', 1) }}",
                y: {{ str_replace(',', '.', $data['animals_cat'] * $data['animals_total'] / 100) }}
            }, {
                name: "{{ trans_choice('animals.kind.horse', 1) }}",
                y: {{ str_replace(',', '.', $data['animals_horse'] * $data['animals_total'] / 100) }}
            }, {
                name: "{{ trans_choice('animals.kind.rodent', 1) }}",
                y: {{ str_replace(',', '.', $data['animals_rodent'] * $data['animals_total'] / 100) }}
            }, {
                name: "{{ trans_choice('animals.kind.bird', 1) }}",
                y: {{ str_replace(',', '.', $data['animals_bird'] * $data['animals_total'] / 100) }}
            }, {
                name: "{{ trans_choice('animals.kind.reptile', 1) }}",
                y: {{ str_replace(',', '.', $data['animals_reptile'] * $data['animals_total'] / 100) }}
            }, {
                name: "{{ trans_choice('animals.kind.other', 1) }}",
                y: {{ str_replace(',', '.', $data['animals_other'] * $data['animals_total'] / 100) }}
            }
            ]
        }]
    });

</script>
@endpush

@section('page.help.text')
    <p>En esta página se muestran las estadísticas globales de la protectora.</p>
    <p><strong>VISITAS Y VISUALIZACIONES:</strong><br> Muestra en un gráfico las visitas (usuarios) y visualizaciones (páginas vistas) del último mes.</p>
    <p><strong>ESTADÍSTICAS GENERALES:</strong><br> Muestra una tabla con las estadísticas en números de la protectora. Por ej: cuántos animales hay adoptados, cuántos artículos, páginas, formularios, socios, etc.</p>
    <p><strong>ANIMALES POR ESPECIE:</strong><br> Muestra un gráfico de los animales por especie.</p>
    <p><strong>ANIMALES POR ESTADO:</strong><br> Muestra un gráfico de los animales por estado.</p>
    <p><strong>ANIMALES POR GÉNERO:</strong><br> Muestra un gráfico de los animales por género.</p>
    <p><strong>ANIMALES POR LOCALIZACIÓN:</strong><br> Muestra un gráfico de los animales por localización.</p>
@endsection
