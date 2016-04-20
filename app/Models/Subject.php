<?php

namespace App\Models;

use Phalcon\Mvc\Model\Validator\StringLength;

class Subject extends BaseModel
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $degree_id;

    /**
     * @var int
     */
    public $recognizer_id;

    public function initialize()
    {
        parent::initialize();

        $this->belongsTo(
            'degree_id',
            'App\Models\Degree',
            'id',
            [
                'alias'      => 'Degree',
                'foreignKey' => true
            ]
        );

        $this->belongsTo(
            'recognizer_id',
            'App\Models\Recognizer',
            'id',
            [
                'alias'      => 'Recognizer',
                'foreignKey' => [
                    'allowNulls' => true
                ]
            ]
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\SubjectEquivalentSubject',
            'subject_id',
            'subject_id',
            'App\Models\Subject',
            'id',
            ['alias' => 'EquivalentBySubject']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\SubjectEquivalentSubject',
            'subject_id_eq',
            'subject_id',
            'App\Models\Subject',
            'id',
            ['alias' => 'SubjectByEquivalent']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Equivalence',
            'subject_id',
            'subject_id',
            'App\Models\Subject',
            'id',
            ['alias' => 'EquivalentBySubject']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Equivalence',
            'subject_id_eq',
            'subject_id',
            'App\Models\Subject',
            'id',
            ['alias' => 'SubjectByEquivalent']
        );
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
