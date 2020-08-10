<?php

return [
    'rules' => [
        'name'          => 'rules',
        'label'         => 'rules::seat.rules',
        'plural'        => true,
        'icon'          => 'fa-file',
        'route_segment' => 'rules',
        'entries'       => [
            [
                'name'  => 'rules',
                'label' => 'rules::seat.all_rules',
                'icon'  => 'fa-file',
                'route' => 'rules.show',
            ],
            [
                'name'  => 'add',
                'label' => 'rules::seat.manage',
                'icon'  => 'fa-list',
                'route' => 'rules.list',
                'permission'    => 'global.superuser',
            ],
        ],
    ],
];