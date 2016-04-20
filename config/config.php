<?php

getenv('APP_ENV') || putenv('APP_ENV=' . DEV);

// Load required environment variables from .env in development or testing. Never in production.
// To avoid file loading overhead.
$env = getenv('APP_ENV');
$dotenv = new Dotenv\Dotenv(__DIR__);
if ($env != PRODUCTION) {
    $dotenv->load();
}
// Required ENV vars for this app
$dotenv->required([
    'APP_ENV',
    'DB_HOST',
    'DB_USER',
    'DB_PASS',
    'DB_NAME',
    'APP_DOMAIN',
]);

$main_config = new \Phalcon\Config([
    'database' => [
        'adapter'   => 'mysql',
        'host'      => getenv('DB_HOST'),
        'username'  => getenv('DB_USER'),
        'password'  => getenv('DB_PASS'),
        'dbname'    => getenv('DB_NAME'),
        'port'      => 3306,
        'charset'   => 'utf8',
    ],
    'application' => [
        'controllersDir'    => APP_PATH . '/app/Controllers/',
        'modelsDir'         => APP_PATH . '/app/Models/',
        'migrationsDir'     => APP_PATH . '/app/Db/Migrations/',
        'baseUri'           => '/',
        'domain'            => getenv('APP_DOMAIN'),
    ],
    'debug'  => false,
]);

// Merge configs depending on the app environment
$env_config = include APP_PATH . '/config/environments/' . $env . '.php';

return $main_config->merge($env_config);
