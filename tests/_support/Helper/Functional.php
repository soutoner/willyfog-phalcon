<?php

namespace Helper;

use App\Db\Seeds\DatabaseSeeder;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Functional extends \Codeception\Module
{
    /**
     * Before each test.
     *
     * @param \Codeception\TestCase $test
     */
    public function _before(\Codeception\TestCase $test)
    {
        // Populate DB
        DatabaseSeeder::Seed(false);
    }

    /**
     * Check if a function throws an error.
     *
     * @param null $exception
     * @param $function
     *
     * @return bool
     */
    public function seeExceptionThrown($function, $exception = null)
    {
        $failed = true;
        try {
            $function();
            $failed = false;
        } catch (\Exception $e) {
            if ($exception !== null) {
                $this->assertEquals($exception, get_class($e));
            }
        }

        return $failed;
    }
}
