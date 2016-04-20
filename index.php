<?php

/**
 * Define constants like environments.
 */
require_once __DIR__ . '/config/constants.php';

// In production turn error_reporting to none
if (getenv('APP_ENV') == PRODUCTION) {
    error_reporting(0);
} else {
    error_reporting(E_ALL);
}

try {
    /**
     * Require Autoloader.
     */
    require APP_PATH . '/bootstrap/autoload.php';

    /**
     * Start the app.
     */
    $app = require_once APP_PATH . '/bootstrap/app.php';

    /**
     * Handle requests.
     */
    $app->handle();
} catch (\Exception $e) {
    if (getenv('APP_ENV') != PRODUCTION) {
        echo $e->getMessage() . '<br>';
        echo '<pre>' . $e->getTraceAsString() . '</pre>';
    }
}
