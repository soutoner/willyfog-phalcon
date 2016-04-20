<?php

namespace Models;

use App\Db\Seeds\Models\LogGrantSeeder;
use App\Models\LogGrant;
use FunctionalTester;

class LogGrantCest
{
    /**
     * @var LogGrant
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new LogGrant();
        $this->model->assign(LogGrantSeeder::ExtraSeeds(0));
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    public function givenModelIsValid(FunctionalTester $I)
    {
        $I->assertTrue($this->model->save(), $this->model->getMessages());
    }

    public function adminIsRequired(FunctionalTester $I)
    {
        $this->model->admin_id = null;
        $I->assertFalse($this->model->save());
    }

    public function adminMustBeValid(FunctionalTester $I)
    {
        $this->model->admin_id = 0;
        $I->assertFalse($this->model->save());
    }
}
