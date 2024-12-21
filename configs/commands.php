<?php
return [
    'setup' => [
        [
            'command' => 'migration:run',
            'description' => 'Create migration file',
        ],
        [
            'command' => 'migration:create',
            'description' => 'Create migration file',
            'arguments' => [
                [
                    'name' => 'name',
                    'required' => true,
                    'description' => 'Migration file name'
                ]
            ]
        ]

    ],
    'commands' => [
        'migration:create' => \App\Commands\Migrations\Create::class,
        'migration:run' => \App\Commands\Migrations\Run::class
    ],
];