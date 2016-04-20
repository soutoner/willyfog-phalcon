<?php

return new \Phalcon\Config(
    [
        'database' => [
            'dbname'    => getenv('DB_NAME') . '_dev',
        ],
        'debug' => true,
    ]
);
