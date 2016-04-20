<?php

namespace Models;

use App\Db\Seeds\Models\EquivalenceSeeder;
use App\Models\Equivalence;
use FunctionalTester;

class EquivalenceCest
{
    /**
     * @var Equivalence
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Equivalence();
        $this->model->assign(EquivalenceSeeder::ExtraSeeds(0));
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

    public function testWrongSubject(FunctionalTester $I)
    {
        $this->model->subject_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function testWrongSubjectEq(FunctionalTester $I)
    {
        $this->model->subject_id_eq = 0;
        $I->assertFalse($this->model->save());
    }

    public function subjectMustBeValid(FunctionalTester $I)
    {
        $this->model->subject_id = null;
        $I->assertFalse($this->model->save());
    }

    public function subjectEqMustBeValid(FunctionalTester $I)
    {
        $this->model->subject_id_eq = null;
        $I->assertFalse($this->model->save());
    }

    public function subjectAndSubjectEqAreUnique(FunctionalTester $I)
    {
        $db_seed = EquivalenceSeeder::DbSeeds(0, true);
        $this->model->subject_id = $db_seed->subject_id;
        $this->model->subject_id_eq = $db_seed->subject_id_eq;
        $I->assertFalse($this->model->save());
    }

    public function subjectAndSubjectEqAreDifferent(FunctionalTester $I)
    {
        $this->model->subject_id = $this->model->subject_id_eq;
        $I->assertFalse($this->model->save());
    }
}
