<?php

namespace Models;

use App\Db\Seeds\Models\Relationships\LogGrantPermittedCentreSeeder;
use App\Models\Relationships\LogGrantPermittedCentre;
use FunctionalTester;

class LogGrantPermittedCentreCest
{
    /**
     * @var LogGrantPermittedCentre
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new LogGrantPermittedCentre();
        $this->model->assign(LogGrantPermittedCentreSeeder::ExtraSeeds(0));
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    public function givenModelIsValid(FunctionalTester $I)
    {
        $I->assertTrue($this->model->save(), $this->model->getMessages());
    }

    public function logGrantIsRequired(FunctionalTester $I)
    {
        $this->model->log_grant_id = null;
        $I->assertFalse($this->model->save());
    }

    public function logGrantMustBeValid(FunctionalTester $I)
    {
        $this->model->log_grant_id = 0;
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

    public function logGrantAndCentreAreUnique(FunctionalTester $I)
    {
        $db_seed = LogGrantPermittedCentreSeeder::DbSeeds(0, true);
        $this->model->log_grant_id = $db_seed->log_grant_id;
        $this->model->centre_id = $db_seed->centre_id;
        $I->assertFalse($this->model->save());
    }
}
