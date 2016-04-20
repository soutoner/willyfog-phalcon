<?php

namespace Models;

use App\Db\Seeds\Models\StudentSeeder;
use App\Models\Student;
use FunctionalTester;

class StudentCest
{
    /**
     * @var Student
     */
    public $model;

    public function _before(FunctionalTester $I)
    {
        $this->model = new Student();
        $this->model->assign(StudentSeeder::ExtraSeeds()[0]);
    }

    public function _after(FunctionalTester $I)
    {
        unset($this->model);
    }

    public function testModelValue(FunctionalTester $I)
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
        $this->model->nif = '111111111111111H';
        $I->assertFalse($this->model->save());
    }

    public function testSurnameTooLong(FunctionalTester $I)
    {
        $this->model->surname = 'Apellidos muy largos esto no se puede tolerar en la base de datos, aunque seas un noble descendiente de la dinastia';
        $I->assertFalse($this->model->save());
    }

    public function testIncorrectEmailWithOutAt(FunctionalTester $I)
    {
        $this->model->email = 'correo';
        $I->assertFalse($this->model->save());
    }

    public function testEmailTooLong(FunctionalTester $I)
    {
        $this->model->email = 'correomuylaaaaaaaaaaaaaaaaaaaaaaargo@gmaiLLLLLLLLLLLLLLLLLLLLLL.com';
        $I->assertFalse($this->model->save());
    }

    public function testEmailModel(FunctionalTester $I)
    {
        $this->model->email = 'pepe_tony@gmail.com';
        $I->assertTrue($this->model->save());
    }
}
