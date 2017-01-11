<?php

return [

    'kind' => [
        'dog' => 'Perro|Perros',
        'cat' => 'Gato|Gatos',
        'horse' => 'Caballo|Caballos',
        'rodent' => 'Roedor|Roedores',
        'bird' => 'Ave|Aves',
        'reptile' => 'Reptíl|Reptiles',
        'other' => 'Otro|Otros'
    ],

    'status' => [
        'adoption' => 'En adopción|En adopción',
        'adopted' => 'Adoptado|Adoptados',
        'reserved' => 'Reservado|Reservados',
        'unavailable' => 'No disponible|No disponible',
        'dead' => 'Fallecido|Fallecidos',
        'found' => 'Encontrado|Encontrados',
        'lost' => 'Perdido|Perdidos'
    ],

    'location' => [
        'shelter' => 'Protectora',
        'temporary_home' => 'Acogida',
        'animal_home' => 'Residencia',
        'street' => 'Calle',
        'unknown' => 'Desconocido',
        'family' => 'Con su nueva familia'
    ],

    'gender' => [
        'unknown' => 'Desconocido',
        'male' => 'Macho|Machos',
        'female' => 'Hembra|Hembras'
    ],

    'visible' => [
        'visible' => 'Visible',
        'hidden' => 'Oculto'
    ],

    'health' => [

        'treatments' => [
            'time' => [
                'hour' => 'hora/s',
                'day' => 'día/s',
                'week' => 'semana/s',
                'month' => 'mes/es',
                'year' => 'año/s'
            ],
            'life' => [
                0 => 'No',
                1 => 'Si'
            ]
        ],

        'type' => [
            'treatment' => 'Tratamiento',
            'vaccine' => 'Vacuna',
            'operation' => 'Operación',
            'review' => 'Revisión',
            'appointment' => 'Cita',
            'test' => 'Prueba',
            'disease' => 'Enfermedad'
        ],

        'test' => [
            'positive' => 'Positivo',
            'negative' => 'Negativo',
            'pending' => 'Pendiente',
            'undefined' => 'Sin definir'
        ]
    ],

    'sponsorships' => [

        'visible' => [
            'visible' => 'Visible',
            'hidden' => 'Oculto'
        ],

        'status' => [
            'active' => 'Activo',
            'inactive' => 'Inactivo'
        ],

        'donation_time' => [
            'unknown' => 'Desconocido',
            'day' => 'Diaria',
            'week' => 'Semanal',
            'month' => 'Mensual',
            'year' => 'Anual'
        ],

        'payment_method' => [
            null => 'Sin especificar',
            'cash' => 'En efectivo',
            'wire_transfer' => 'Transferencia bancaria'
        ]
    ]

];
