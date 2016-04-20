<?php

namespace Models;

use App\Db\Seeds\Models\CoordinatorSeeder;
use App\Models\Coordinator;
use FunctionalTester;

class CoordinatorCest
{
    /**
     * @var Coordinator
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Coordinator();
        $this->model->assign(CoordinatorSeeder::ExtraSeeds(0));
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    // TESTS
}
