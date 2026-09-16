<?php

$host1 = env('DB_HOST1');
$dbname1 = env('DB_NAME1');
$port1 = env('DB_PORT1');
$username1 = env('DB_USER1');
$password1 = env('DB_PASS1');

$host2 = env('DB_HOST2');
$dbname2 = env('DB_NAME2');
$port2 = env('DB_PORT2');
$username2 = env('DB_USER2');
$password2 = env('DB_PASS2');

$host3 = env('DB_HOST3');
$dbname3 = env('DB_NAME3');
$port3 = env('DB_PORT3');
$username3 = env('DB_USER3');
$password3 = env('DB_PASS3');

$host4 = env('DB_HOST4');
$dbname4 = env('DB_NAME4');
$port4 = env('DB_PORT4');
$username4 = env('DB_USER4');
$password4 = env('DB_PASS4');

$host5 = env('DB_HOST5');
$dbname5 = env('DB_NAME5');
$port5 = env('DB_PORT5');
$username5 = env('DB_USER5');
$password5 = env('DB_PASS5');

$host6 = env('DB_HOST6');
$dbname6 = env('DB_NAME6');
$port6 = env('DB_PORT6');
$username6 = env('DB_USER6');
$password6 = env('DB_PASS6');

$host7 = env('DB_HOST7');
$dbname7 = env('DB_NAME7');
$port7 = env('DB_PORT7');
$username7 = env('DB_USER7');
$password7 = env('DB_PASS7');

$db = [
    'db1' => [
        'class' => 'yii\db\Connection',
        'dsn' => "pgsql:host=$host1;dbname=$dbname1;port=$port1",
        'username' => $username1,
        'password' => $password1,
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
    ],
    'db2' => [
        'class' => 'yii\db\Connection',
        'dsn' => "pgsql:host=$host2;dbname=$dbname2;port=$port2",
        'username' => $username2,
        'password' => $password2,
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
    ],
    'db3' => [
        'class' => 'yii\db\Connection',
        'dsn' => "mysql:host=$host3;dbname=$dbname3;port=$port3",
        'username' => $username3,
        'password' => $password3,
        'charset' => 'utf8',
        'attributes'=>[
            PDO::ATTR_PERSISTENT => true,
        ],
        'enableSchemaCache' => true,  
        'schemaCacheDuration' => 60,
        'schemaCache' => 'cache',
    ],
    'db4' => [
        'class' => 'yii\db\Connection',
        'dsn' => "mysql:host=$host4;dbname=$dbname4;port=$port4",
        'username' => $username4,
        'password' => $password4,
        'charset' => 'utf8',
        'attributes'=>[
            PDO::ATTR_PERSISTENT => true,
        ],
        'enableSchemaCache' => true,  
        'schemaCacheDuration' => 60,
        'schemaCache' => 'cache',
    ],
    'db5' => [
        'class' => 'yii\db\Connection',
        'dsn' => "mysql:host=$host5;dbname=$dbname5;port=$port5",
        'username' => $username5,
        'password' => $password5,
        'charset' => 'utf8',
        'attributes'=>[
            PDO::ATTR_PERSISTENT => true,
        ],
        'enableSchemaCache' => true,  
        'schemaCacheDuration' => 60,
        'schemaCache' => 'cache',
    ],
    'db6' => [
        'class' => 'yii\db\Connection',
        'dsn' => "mysql:host=$host6;dbname=$dbname6;port=$port6",
        'username' => $username6,
        'password' => $password6,
        'charset' => 'utf8',
        'attributes'=>[
            PDO::ATTR_PERSISTENT => true,
        ],
        'enableSchemaCache' => true,  
        'schemaCacheDuration' => 60,
        'schemaCache' => 'cache',
    ],
    'db7' => [
        'class' => 'yii\db\Connection',
        'dsn' => "pgsql:host=$host7;dbname=$dbname7;port=$port7",
        'username' => $username7,
        'password' => $password7,
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
    ],
];

return $db;