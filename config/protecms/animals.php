<?php

return [

    'kind' => [
        'dog',
        'cat',
        'horse',
        'rodent',
        'bird',
        'reptile',
        'other'
    ],

    'status' => [
        'adoption',
        'adopted',
        'reserved',
        'unavailable',
        'dead',
        'found',
        'lost'
    ],

    'location' => [
        'shelter',
        'temporary_home',
        'animal_home',
        'street',
        'unknown',
        'family'
    ],

    'gender' => [
        'male',
        'female',
        'unknown'
    ],

    'visible' => [
        'visible',
        'hidden'
    ],

    'health' => [

        'treatments' => [
            'time' => [
                'hour',
                'day',
                'week',
                'month',
                'year'
            ],

            'life' => [
                0,
                1
            ]
        ],

        'type' => [
            'treatment',
            'vaccine',
            'operation',
            'review',
            'appointment',
            'test',
            'disease'
        ],

        'test' => [
            'positive',
            'negative',
            'pending',
            'undefined'
        ]
    ],

    'sponsorships' => [

        'visible' => [
            'hidden',
            'visible'
        ],

        'status' => [
            'active',
            'inactive'
        ],

        'donation_time' => [
            'unknown',
            'day',
            'week',
            'month',
            'year',
        ],

        'payment_method' => [
            null,
            'cash',
            'wire_transfer',
        ]
    ]

];
