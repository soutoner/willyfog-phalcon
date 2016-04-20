<?php

namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Unit extends \Codeception\Module
{
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
