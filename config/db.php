<?php
$ini = parse_ini_file(__DIR__ . '/passwords.ini', true);

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2_smart_tech',
    'username' => $ini['db']['username'],
    'password' => $ini['db']['password'],
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
