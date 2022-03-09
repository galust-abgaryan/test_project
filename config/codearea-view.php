<?php
//https://themes-pixeden.com/font-demos/7-stroke/
return [
    'actions' => [
        'edit' => [
            'icon' => 'pen',
        ],
        'show' => [
            'icon' => 'eye',
        ],
        'destroy' => [
            'icon' => 'trash',
        ],
    ],
    'sidebar' => [
        [
            'header' => 'Dashboard',
            'sidebars' => [
                [
                    'label' => 'Users',
                    'route' => 'users.index',
                    'icon' => 'user',
                ],
                [
                    'label' => 'Mail templates',
                    'route' => 'mail-templates.index',
                    'icon' => 'mail',
                ],
                [
                    'label' => 'Graphiks',
                    'route' => 'graphik.index',
                    'icon' => 'check',
                ],
            ],
        ],
    ]
];
