<?php

namespace Models;

use App\Db\Seeds\Models\Relationships\AccessTokenGrantsCentreSeeder;
use App\Models\Relationships\AccessTokenGrantsCentre;
use FunctionalTester;

class AccessTokenGrantsCentreCest
{
    /**
     * @var AccessTokenGrantsCentre
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new AccessTokenGrantsCentre();
        $this->model->assign(AccessTokenGrantsCentreSeeder::ExtraSeeds(0));
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    public function givenModelIsValid(FunctionalTester $I)
    {
        $I->assertTrue($this->model->save(), $this->model->getMessages());
    }

    public function accessTokenIsRequired(FunctionalTester $I)
    {
        $this->model->access_token_id = null;
        $I->assertFalse($this->model->save());
    }

    public function accessTokenMustBeValid(FunctionalTester $I)
    {
        $this->model->access_token_id = 0;
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

    public function accessTokenAndCentreAndCityAndCountryAreUnique(FunctionalTester $I)
    {
        $db_seed = AccessTokenGrantsCentreSeeder::DbSeeds(0, true);
        $this->model->access_token_id = $db_seed->access_token_id;
        $this->model->centre_id = $db_seed->centre_id;
        $I->assertFalse($this->model->save());
    }
}
