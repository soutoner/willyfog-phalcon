<?php

// Set TEST environment
putenv('APP_ENV=test');

// Run migrations
echo shell_exec('php app/cli.php migrate test');
