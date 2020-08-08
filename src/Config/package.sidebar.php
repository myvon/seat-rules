<?php

return [
    'rules' => [
        'name'          => 'rules',
        'label'         => 'rules::seat.rules',
        'plural'        => true,
        'icon'          => 'fas fa-building',
        'route_segment' => 'rules',
        'entries'       => [
            [
                'name'  => 'rules',
                'label' => 'rules::seat.all_rules',
                'icon'  => 'fas fa-hotel',
                'route' => 'rules.show',
            ],
            [
                'name'  => 'add',
                'label' => 'rules::seat.manage',
                'icon'  => 'fas fa-hotel',
                'route' => 'rules.list',
                'permission'    => 'global.superuser',
            ],
        ],
    ],
];