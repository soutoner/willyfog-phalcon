<?php

namespace Models;

use App\Db\Seeds\Models\ProfessorSeeder;
use App\Models\Professor;
use FunctionalTester;

class ProfessorCest
{
    /**
     * @var Professor
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Professor();
        $this->model->assign(ProfessorSeeder::ExtraSeeds(0));
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    // TESTS

    public function validProfessor(FunctionalTester $I)
    {
        $I->assertTrue($this->model->save());
    }

    public function testNameTooLong(FunctionalTester $I)
    {
        $this->model->name = 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
        $I->assertFalse($this->model->save());
    }

    public function testNifTooLong(FunctionalTester $I)
    {
        $this->model->nif = '123123123123123A';
        $I->assertFalse($this->model->save());
    }

    public function testSurnameTooLong(FunctionalTester $I)
    {
        $this->model->surname = 'Apellidooooooooosssssssss Muyy grande claro hombre claro! Jajajaja locurica';
        $I->assertFalse($this->model->save());
    }

    public function testWrongEmail(FunctionalTester $I)
    {
        $this->model->surname = 'morci@';
        $I->assertFalse($this->model->save());
    }

    public function testWrongIdRecognizer(FunctionalTester $I)
    {
        $this->model->recognizer_id = 0;
        $I->assertFalse($this->model->save());
    }

    public function testWrongIdCoordinator(FunctionalTester $I)
    {
        $this->model->coordinator_id = 0;
        $I->assertFalse($this->model->save());
    }
}
