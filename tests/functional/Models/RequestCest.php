<?php

namespace Models;

use App\Db\Seeds\Models\RequestSeeder;
use App\Models\Request;
use FunctionalTester;

class RequestCest
{
    /**
     * @var Request
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Request();
        $this->model->assign(RequestSeeder::ExtraSeeds(0));
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    // TESTS

    public function studentMustBeValid(FunctionalTester $I)
    {
        $this->model->student_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function recognizerMustBeValid(FunctionalTester $I)
    {
        $this->model->recognizer_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function studentNotBeNull(FunctionalTester $I)
    {
        $this->model->student_id = null;
        $I->assertFalse($this->model->save());
    }
}
