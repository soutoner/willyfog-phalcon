<?php

namespace Models\Relationships;

use App\Db\Seeds\Models\Relationships\CoordinatorCoordCentreSeeder;
use App\Models\Relationships\CoordinatorCoordCentre;
use FunctionalTester;

class CoordinatorCoordCentreCest
{
    /**
     * @var CoordinatorCoordCentre
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new CoordinatorCoordCentre();
        $this->model->assign(CoordinatorCoordCentreSeeder::ExtraSeeds(0));
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    // TESTS

    public function givenModelIsValid(FunctionalTester $I)
    {
        $I->assertTrue($this->model->save(), $this->model->getMessages());
    }

    public function coordinatorIsRequired(FunctionalTester $I)
    {
        $this->model->coordinator_id = null;
        $I->assertFalse($this->model->save());
    }

    public function coordinatorMustBeValid(FunctionalTester $I)
    {
        $this->model->coordinator_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function centreIsRequired(FunctionalTester $I)
    {
        $this->model->centre_id = null;
        $I->assertFalse($this->model->save());
    }

    public function centreMustBeValid(FunctionalTester $I)
    {
        $this->model->centre_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function coordinatorAndCentreAreUnique(FunctionalTester $I)
    {
        $db_seed = CoordinatorCoordCentreSeeder::DbSeeds(0, true);
        $this->model->coordinator_id = $db_seed->coordinator_id;
        $this->model->centre_id = $db_seed->centre_id;
        $I->assertFalse($this->model->save());
    }
}
