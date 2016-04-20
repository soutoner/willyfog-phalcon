<?php

namespace Models;

use App\Db\Seeds\Models\AdminSeeder;
use App\Models\Admin;
use FunctionalTester;

class AdminCest
{
    /**
     * @var Admin
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Admin();
        $this->model->assign(AdminSeeder::ExtraSeeds(0));
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    public function givenModelIsValid(FunctionalTester $I)
    {
        $I->assertTrue($this->model->save(), $this->model->getMessages());
    }

    public function emailIsRequired(FunctionalTester $I)
    {
        $this->model->email = null;
        $I->assertFalse($this->model->save());
    }

    public function emailIsUnique(FunctionalTester $I)
    {
        $this->model->email = AdminSeeder::DbSeeds(0, true)->email;
        $I->assertFalse($this->model->save());
    }

    public function emailUnder45(FunctionalTester $I)
    {
        $this->model->email = str_repeat('a', 46);
        $I->assertFalse($this->model->save());
    }

    public function emailValid(FunctionalTester $I)
    {
        $this->model->email = 'hols.kase.com';
        $I->assertFalse($this->model->save());
    }

    public function digestIsRequired(FunctionalTester $I)
    {
        $this->model->digest = null;
        $I->assertFalse($this->model->save());
    }

    public function digestUnder45(FunctionalTester $I)
    {
        $this->model->digest = str_repeat('a', 46);
        $I->assertFalse($this->model->save());
    }
}
