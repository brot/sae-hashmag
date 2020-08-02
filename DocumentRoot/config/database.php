<?php

return [
    'host' => getenv('DB_CONTAINER_NAME', true),
    'username' => getenv('MYSQL_USER', true),
    'password' => getenv('MYSQL_PASSWORD', true),
    'dbname' => getenv('MYSQL_DATABASE', true),
    'port' => getenv('DB_CONTAINER_PORT', true)
];
