<?php

return [
    'propel' => [
        'database' => [
            'connections' => [
                'default' => [
                    'adapter' => 'mysql',
                    'classname' => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn' => 'mysql:host=192.168.200.20;dbname=tholdi_resa.com',
                    'user' => 'root',
                    'password' => 'Azerty1',
                    'attributes' => []
                ],
            ]
        ],
        'general' => [
            'project' => 'tholdi-resa'
        ],
        'paths' => [
            'projectDir' => '/var/www/html/tholdi-resa.com',
            'schemaDir' => '/var/www/html/tholdi-resa.com/script',
            'phpDir' => '/var/www/html/tholdi-resa.com/app/Http/Model'
        ],
        'runtime' => [
            'defaultConnection' => 'default',
            'connections' => ['default']
        ],
        'generator' => [
            'defaultConnection' => 'default',
            'connections' => ['default']
        ]
    ]
]; 
