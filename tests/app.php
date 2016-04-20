<?php

/**
 * Needed by Codeception Phalcon2 module.
 */
// Enter TEST environment
putenv('APP_ENV=test');

/**
 * Define constants like environments.
 */
require_once __DIR__ . '/../config/constants.php';

/**
 * Require Autoloader.
 */
require APP_PATH . '/bootstrap/autoload.php';

$app = require APP_PATH . '/bootstrap/app.php';

return $app;
