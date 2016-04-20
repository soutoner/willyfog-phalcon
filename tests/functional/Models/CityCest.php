<?php

namespace Models;

use App\Db\Seeds\Models\CitySeeder;
use App\Models\City;
use FunctionalTester;

class CityCest
{
    /**
     * @var City
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new City();
        $this->model->assign(CitySeeder::ExtraSeeds(0));
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

    public function testNameTooLong(FunctionalTester $I)
    {
        $this->model->name = str_repeat('a', 121);
        $I->assertFalse($this->model->save());
    }

    public function countryIsRequired(FunctionalTester $I)
    {
        $this->model->country_id = null;
        $I->assertFalse($this->model->save());
    }

    public function countryMustBeValid(FunctionalTester $I)
    {
        $this->model->country_id = 0;
        $I->assertFalse($this->model->save());
    }
}
