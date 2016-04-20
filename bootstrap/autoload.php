<?php

/**
 * Include Composer packages.
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * Include our autoloader class.
 */
require_once 'Autoloader/Psr4AutoloaderClass.php';

// instantiate the loader
$loader = new Bootstrap\Autoloader\Psr4AutoloaderClass();

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('App\\', __DIR__ . '/../app');
