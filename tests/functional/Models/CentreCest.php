<?php

namespace Models;

use App\Db\Seeds\Models\CentreSeeder;
use App\Models\Centre;
use FunctionalTester;

class CentreCest
{
    /**
     * @var Centre
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Centre();
        $this->model->assign(CentreSeeder::ExtraSeeds(0));
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

    public function nameIsUnique(FunctionalTester $I)
    {
        $this->model->name = CentreSeeder::DbSeeds(0, true)->name;
        $I->assertFalse($this->model->save());
    }

    public function nameLengthUnder100(FunctionalTester $I)
    {
        $this->model->name = str_repeat('a', 101);
        $I->assertFalse($this->model->save());
    }

    public function cityIsRequired(FunctionalTester $I)
    {
        $this->model->city_id = null;
        $I->assertFalse($this->model->save());
    }

    public function cityMustBeValid(FunctionalTester $I)
    {
        $this->model->city_id = 0;
        $I->assertFalse($this->model->save());
    }
}
