<?php

namespace App\Tasks;

use App\Db\Seeds\DatabaseSeeder;
use Phalcon\CLI\Task;

class SeedTask extends Task
{
    public function mainAction()
    {
        // Run migrations if necessary
        echo shell_exec('php vendor/bin/phinx migrate -c config/phinx.php') . "\n";

        DatabaseSeeder::Seed();
    }
}
