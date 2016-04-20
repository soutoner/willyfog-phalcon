<?php

namespace Models;

use App\Db\Seeds\Models\Relationships\StudentEnrolledDegreeSeeder;
use App\Models\Relationships\StudentEnrolledDegree;
use FunctionalTester;

class StudentEnrolledDegreeCest
{
    /**
     * @var StudentEnrolledDegree
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new StudentEnrolledDegree();
        $this->model->assign(StudentEnrolledDegreeSeeder::ExtraSeeds(0));
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    public function givenModelIsValid(FunctionalTester $I)
    {
        $I->assertTrue($this->model->save(), $this->model->getMessages());
    }

    public function studentIsRequired(FunctionalTester $I)
    {
        $this->model->student_id = null;
        $I->assertFalse($this->model->save());
    }

    public function studentMustBeValid(FunctionalTester $I)
    {
        $this->model->student_id = 0;
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

    public function studentAndDegreeAreUnique(FunctionalTester $I)
    {
        $db_seed = StudentEnrolledDegreeSeeder::DbSeeds(0, true);
        $this->model->student_id = $db_seed->student_id;
        $this->model->degree_id = $db_seed->degree_id;
        $I->assertFalse($this->model->save());
    }
}
