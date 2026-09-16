<?php
$host = env('DB_HOST');
$dbname = env('DB_NAME');
$port = env('DB_PORT');
$username = env('DB_USER');
$password = env('DB_PASS');

return [
    'class' => 'yii\db\Connection',
    'dsn' => "pgsql:host=$host;dbname=$dbname;port=$port",
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',
    'schemaMap' => [
        'pgsql' => [
            'class' => 'yii\db\pgsql\Schema',
            'defaultSchema' => 'public' 
        ],
    ],
    'enableSchemaCache' => true,  
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];
