<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Ficha de {{ $animal->name }}</title>

    <style>
        h1 {
            margin-bottom: 5%;
        }

        .animal-data {
            width: 65%;
            float: left;
            margin-bottom: 3%;
        }

        .animal-data h3 {
            margin-bottom: 2%
        }
        
        .animal-photo {
            width: 35%;
            margin-top: 4%;
            float: right;
        }

        .animal-photo img {
            max-width: 100%;
            display: block;
            margin: 0 auto;
        }

        .animal-text {
            display: block;
            width: 100%;
        }

        .animal-text h3 {
            margin-bottom: 5%;
        }

        .text-right {
            text-align: right;
        }

        table {
            margin-left: 2%;
        }

        table td {
            padding: 10px 5px;
        }

        .clearfix {
            clear: both;
        }

        footer {
            display: block;
            position: absolute;
            bottom: 0%;
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>

    <div class="animal-data">
        <h1>Ficha de {{ $animal->name }}</h1>
        <h3>Datos</h3>
        <table class="table">
            <tbody>
                <tr class="first">
                    <td class="text-right"><strong>Nombre</strong></td>
                    <td>{{ $animal->name }}</td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Edad</strong></td>
                    <td>{{ $animal->birthDateDiffForHumans() }}</td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Género</strong></td>
                    <td>{{ trans_choice('animals.gender.' . $animal->gender, 1) }}</td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Especie</strong></td>
                    <td>{{ trans_choice('animals.kind.' . $animal->kind, 1) }}</td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Raza</strong></td>
                    <td>{{ $animal->breed }}</td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Estado</strong></td>
                    <td>{{ trans_choice('animals.status.' . $animal->status, 1) }}</td>
                </tr>
                @if ($animal->status != 'dead')
                <tr>
                    <td class="text-right"><strong>Localización</strong></td>
                    <td>{{ trans('animals.location.' . $animal->location) }}</td>
                </tr>
                <tr>
                    <td class="text-right"><strong>Salud</strong></td>
                    <td>{{ $animal->health_text ?: '-' }}</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="animal-photo">
        @if (count($animal->photos))
            <img src="{{ $animal->photos[0]->medium_thumbnail_url }}" alt="">
        @else
            <img src="{{ $animal->web->getUrl() . '/' . Theme::url('images/animal-default.jpg') }}" alt="">
        @endif
    </div>
    <div class="clearfix"></div>
    <div class="animal-text">
        <h3>Descripción</h3>
        {!! $animal->text !!}
    </div>
    <footer>
        {{ $animal->web->name }} - {{ $animal->web->getUrl() }}
    </footer>
</body>
</html>