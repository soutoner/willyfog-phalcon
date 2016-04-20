<?php

/**
 * Require Phalcon configurations for different environments.
 *
 * TODO: uncomment 'production' environment when necessary.
 */

/**
 * Define constants like environments.
 */
require_once __DIR__ . '/constants.php';

/*putenv('APP_ENV=production');

$prod_config = require __DIR__ . '/config.php';
$prod_config = $prod_config->database;*/

putenv('APP_ENV=development');

$dev_config = require __DIR__ . '/config.php';
$dev_config = $dev_config->database;

putenv('APP_ENV=test');

$test_config = require __DIR__ . '/config.php';
$test_config = $test_config->database;

return [
    'paths' => [
        'migrations'    => 'app/Db/Migrations',
        'seeds'         => 'app/Db/Seeds'
    ],
    'environments' => [
        'default_migration_table'   => 'phinxlog',
        'default_database'          => 'development',
        /*'production' => array(
            'adapter'       => $prod_config->adapter,
            'host'          => $prod_config->host,
            'name'          => $prod_config->dbname,
            'user'          => $prod_config->username,
            'pass'          => $prod_config->password,
            'port'          => $prod_config->port,
            'charset'       => $prod_config->charset,
        ),*/
        'development' => [
            'adapter'       => $dev_config->adapter,
            'host'          => $dev_config->host,
            'name'          => $dev_config->dbname,
            'user'          => $dev_config->username,
            'pass'          => $dev_config->password,
            'port'          => $dev_config->port,
            'charset'       => $dev_config->charset,
        ],
        'test' => [
            'adapter'       => $test_config->adapter,
            'host'          => $test_config->host,
            'name'          => $test_config->dbname,
            'user'          => $test_config->username,
            'pass'          => $test_config->password,
            'port'          => $test_config->port,
            'charset'       => $test_config->charset,
        ]
    ]
];
