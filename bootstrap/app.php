<?php

/**
 * Read the configuration.
 */
$config = include __DIR__ . '/../config/config.php';

/**
 * Read services.
 */
include __DIR__ . '/../config/services.php';

/**
 * Create the app.
 *
 * @var \Phalcon\Mvc\Micro
 */
$app = new \Phalcon\Mvc\Micro($di);

/**
 * Mount collections (routes).
 */
include __DIR__ . '/../bootstrap/mount.php';

return $app;
