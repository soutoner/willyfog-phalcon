<?php

return new \Phalcon\Config(
    [
        'database' => [
            'dbname'    => getenv('DB_NAME') . '_test',
        ]
    ]
);
