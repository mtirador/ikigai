<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=db;dbname=ikigai2',
    'username' => 'user', // Asegúrate de usar el mismo usuario definido en docker-compose.yml
    'password' => 'password', // Asegúrate de usar la misma contraseña definida en docker-compose.yml
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
