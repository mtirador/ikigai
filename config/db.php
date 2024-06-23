<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=db;dbname=ikigai2',
    'username' => 'user', // Username defined in docker-compose.yml
    'password' => 'password', // Password defined in docker-compose.yml
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    // Uncomment the following lines for production:
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
