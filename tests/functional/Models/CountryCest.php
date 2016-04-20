<?php

namespace Models;

use App\Db\Seeds\Models\CountrySeeder;
use App\Models\Country;
use FunctionalTester;

class CountryCest
{
    /**
     * @var Country
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Country();
        $this->model->assign(CountrySeeder::ExtraSeeds(0));
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    // TESTS

    public function testNameTooLong(FunctionalTester $I)
    {
        $this->model->name = str_repeat('a', 121);
        $I->assertFalse($this->model->save());
    }
}
