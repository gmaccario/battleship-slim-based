<?php
return [
    'propel' => [
        'database' => [
            'connections' => [
                'battleship' => [
                    'adapter' => 'mysql',
                    'dsn' => 'mysql:host=localhost;port=3306;dbname=battleship',
                    'user' => 'root',
                    'password' => 'tiger',
                    'settings' => [
                        'charset' => 'utf8'
                    ]
                ]
            ]
        ]
    ]
];
