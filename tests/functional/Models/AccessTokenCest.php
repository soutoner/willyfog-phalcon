<?php

namespace Models;

use App\Db\Seeds\Models\AccessTokenSeeder;
use App\Models\AccessToken;
use FunctionalTester;

class AccessTokenCest
{
    /**
     * @var AccessToken
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new AccessToken();
        $this->model->assign(AccessTokenSeeder::ExtraSeeds(0));
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    public function givenModelIsValid(FunctionalTester $I)
    {
        $I->assertTrue($this->model->save(), $this->model->getMessages());
    }

    public function accessTokenIsNotNull(FunctionalTester $I)
    {
        $this->model->access_token = null;
        $I->assertFalse($this->model->save());
    }

    public function accessTokenUnder45(FunctionalTester $I)
    {
        $this->model->access_token = str_repeat('a', 46);
        $I->assertFalse($this->model->save());
    }

    public function accessTokenIsUnique(FunctionalTester $I)
    {
        $this->model->access_token = AccessTokenSeeder::DbSeeds(0, true)->access_token;
        $I->assertFalse($this->model->save());
    }
}
