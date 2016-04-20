<?php

namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class StudentEnrolledDegree extends BaseModel
{
    /**
     * @var int
     */
    public $student_id;

    /**
     * @var int
     */
    public $degree_id;

    public function initialize()
    {
        $this->belongsTo(
            'student_id',
            'App\Models\Student',
            'id',
            [
                'alias'      => 'Student',
                'foreignKey' => true
            ]
        );

        $this->belongsTo(
            'degree_id',
            'App\Models\Degree',
            'id',
            [
                'alias'      => 'Degree',
                'foreignKey' => true
            ]
        );
    }

    public function validation()
    {
        $this->validate(new Uniqueness([
            'field' => ['student_id', 'degree_id']
        ]));

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
