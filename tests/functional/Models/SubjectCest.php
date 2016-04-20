<?php

namespace Models;

use App\Db\Seeds\Models\SubjectSeeder;
use App\Models\Subject;
use FunctionalTester;

class SubjectCest
{
    /**
     * @var Subject
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Subject();
        $this->model->assign(SubjectSeeder::ExtraSeeds(0));
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
        $this->model->name = str_repeat('a', 101);
        $I->assertFalse($this->model->save());
    }

    public function degreeIsRequired(FunctionalTester $I)
    {
        $this->model->degree_id = null;
        $I->assertFalse($this->model->save());
    }

    public function degreeMustBeValid(FunctionalTester $I)
    {
        $this->model->degree_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function recognizerIsNotRequired(FunctionalTester $I)
    {
        $this->model->recognizer_id = null;
        $I->assertTrue($this->model->save());
    }

    public function recognizerMustBeValid(FunctionalTester $I)
    {
        $this->model->recognizer_id = 0;
        $I->assertFalse($this->model->save());
    }
}
