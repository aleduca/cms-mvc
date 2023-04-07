<?php

return [
    'db' => [
        'host' => 'localhost',
        'dbname' => 'cms_mvc',
        'username' => 'root',
        'password' => 'root',
    ],
    'controllers' => [
        'folders' => [
            'site', 'admin',
        ],
    ],
    'email' => [
        'host' => 'smtp.mailtrap.io',
        'username' => '512bf67bbc891e',
        'password' => 'e9591bd8a9c5cd',
        'port' => 465,
        'from' => 'contato@asolucoesweb.com.br',
    ],
    'environment' => [
        'type' => 'dev',
    ],
];
