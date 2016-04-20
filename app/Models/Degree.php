<?php

namespace App\Models;

use Phalcon\Mvc\Model\Validator\StringLength;

class Degree extends BaseModel
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $centre_id;

    public function initialize()
    {
        parent::initialize();

        $this->belongsTo(
            'centre_id',
            'App\Models\Centre',
            'id',
            [
                'alias'      => 'Centre',
                'foreignKey' => true
            ]
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\StudentEnrolledDegree',
            'degree_id',
            'student_id',
            'App\Models\Student',
            'id',
            ['alias' => 'StudentsEnrolled']
        );

        $this->hasMany('id', 'App\Models\Subject', 'subject_id', ['alias' => 'Subjects']);
    }

    public function validation()
    {
        $this->validate(new StringLength([
            'field' => 'name',
            'max'   => 100
        ]));

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
