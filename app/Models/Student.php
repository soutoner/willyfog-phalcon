<?php

namespace App\Models;

use Phalcon\Mvc\Model\Validator\Email;
use Phalcon\Mvc\Model\Validator\StringLength;

class Student extends BaseModel
{
    /**
     * @var string
     */
    public $nif;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $surname;

    /**
     * @var string
     */
    public $email;

    public function initialize()
    {
        parent::initialize();

        $this->hasMany('id', 'App\Models\Request', 'student_id', ['alias' => 'Requests']);

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\StudentEnrolledDegree',
            'student_id',
            'degree_id',
            'App\Models\Degree',
            'id',
            ['alias' => 'EnrolledByStudents']
        );
    }

    public function validation()
    {
        $this->validate(new StringLength([
            'field' => 'nif',
            'max'   => 12
        ]));

        $this->validate(new StringLength([
            'field' => 'name',
            'max'   => 25
        ]));

        $this->validate(new StringLength([
            'field' => 'surname',
            'max'   => 60
        ]));

        $this->validate(new StringLength([
            'field' => 'email',
            'max'   => 45
        ]));

        $this->validate(new Email(['field' => 'email']));

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
