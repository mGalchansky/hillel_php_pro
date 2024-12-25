<?php
return [
    'setup' => [
        [
            'command' => 'migration:rollback',
            'description' => 'Rollback migrations',
        ],
        [
            'command' => 'migration:run',
            'description' => 'Run migrations',
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
        'migration:run' => \App\Commands\Migrations\Run::class,
        'migration:rollback' => \App\Commands\Migrations\Rollback::class
    ],
];