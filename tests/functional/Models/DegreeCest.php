<?php

namespace Models;

use App\Db\Seeds\Models\DegreeSeeder;
use App\Models\Degree;
use FunctionalTester;

class DegreeCest
{
    /**
     * @var Degree
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Degree();
        $this->model->assign(DegreeSeeder::ExtraSeeds(0));
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    public function givenModelIsValid(FunctionalTester $I)
    {
        $I->assertTrue($this->model->save(), $this->model->getMessages());
    }

    public function nameIsRequired(FunctionalTester $I)
    {
        $this->model->name = null;
        $I->assertFalse($this->model->save());
    }

    public function nameLengthUnder100(FunctionalTester $I)
    {
        $this->model->name = $this->model->access_token = str_repeat('a', 101);
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
}
