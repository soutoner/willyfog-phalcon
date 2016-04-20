<?php

use Phalcon\Di\FactoryDefault\Cli as CliDI;
use Phalcon\Cli\Console as ConsoleApp;

define('VERSION', '1.0.0');

// Using the CLI factory default services container
$di = new CliDI();

/**
 * Define constants like environments.
 */
require_once __DIR__ . '/config/constants.php';

/**
 * Register the autoloader and tell it to register the tasks directory.
 */
include APP_PATH . '/bootstrap/autoload.php';

// Load the configuration file (if any)
$config = include APP_PATH . '/config/config.php';

$di->set('config', $config);

$di->setShared('db', function () use ($config) {
    $dbConfig = $config->database->toArray();
    $adapter = $dbConfig['adapter'];
    unset($dbConfig['adapter']);
    $class = 'Phalcon\Db\Adapter\Pdo\\' . $adapter;

    return new $class($dbConfig);
});

// Create a console application
$console = new ConsoleApp();
$console->setDI($di);

/**
 * Process the console arguments.
 */
$arguments = [];
foreach ($argv as $k => $arg) {
    if ($k == 1) {
        $arguments['task'] = 'App\Tasks\\' . ucfirst($arg);
    } elseif ($k == 2) {
        $arguments['action'] = $arg;
    } elseif ($k >= 3) {
        $arguments['params'][] = $arg;
    }
}

// Define global constants for the current task and action
define('CURRENT_TASK', (isset($argv[1]) ? $argv[1] : null));
define('CURRENT_ACTION', (isset($argv[2]) ? $argv[2] : null));

try {
    // Handle incoming arguments
    $console->handle($arguments);
} catch (\Phalcon\Exception $e) {
    echo $e->getMessage();
    exit(255);
}
