<?php

return [

    'config' => [
        'default' => [
            'lang' => 'es',
            'langs' => 'es,en',
            'theme' => 'default',
            'themes.default.color' => '#25c2e6',
            'animals.fields' => json_encode(['name','birth_date','gender','kind','breed','status','location','health_text']),
            'animals.contact_email' => 'web@protecms.com',
            'posts.pagination' => 10
        ]
    ]

];
