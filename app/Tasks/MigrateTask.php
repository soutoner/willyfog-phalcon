<?php

namespace App\Tasks;

use Phalcon\CLI\Task;

class MigrateTask extends Task
{
    public function mainAction()
    {
        // Create test database if not created
        echo shell_exec("mysql -u root -e 'CREATE DATABASE IF NOT EXISTS " . $this->config->database->dbname . ";'");

        // Run migrations if necessary
        echo shell_exec('php vendor/bin/phinx migrate -c config/phinx.php') . "\n";
    }

    public function testAction()
    {
        // Create test database if not created
        echo shell_exec("mysql -u root -e 'CREATE DATABASE IF NOT EXISTS " . $this->config->database->dbname . ";'");
        // Run migrations if necessary
        echo shell_exec('php vendor/bin/phinx migrate -e test -c config/phinx.php') . "\n";
    }
}
