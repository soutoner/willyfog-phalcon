<?php

namespace Controllers\V1;

use Helper\EndpointTest;
use FunctionalTester;

class UsersCest extends EndpointTest
{
    public function __construct()
    {
        parent::__construct(__FILE__);
    }

    public function indexReturnsUsers(FunctionalTester $I)
    {
        //
    }
}
