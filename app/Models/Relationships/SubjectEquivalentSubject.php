<?php

namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class SubjectEquivalentSubject extends BaseModel
{
    /**
     * @var int
     */
    public $subject_id;

    /**
     * @var int
     */
    public $subject_id_eq;

    public function initialize()
    {
        $this->belongsTo(
            'subject_id',
            'App\Models\Subject',
            'id',
            [
                'alias'      => 'Subject',
                'foreignKey' => true
            ]
        );

        $this->belongsTo(
            'subject_id_eq',
            'App\Models\Subject',
            'id',
            [
                'alias'      => 'SubjectEq',
                'foreignKey' => true
            ]
        );
    }

    public function validation()
    {
        $this->validate(new Uniqueness([
            'field' => ['subject_id', 'subject_id_eq']
        ]));

        // Equivalence between one subject and itself
        if ($this->subject_id == $this->subject_id_eq) {
            return false;
        }

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
