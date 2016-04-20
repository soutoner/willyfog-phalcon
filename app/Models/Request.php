<?php

namespace App\Models;

class Request extends BaseModel
{
    /**
     * @var int
     */
    public $student_id;

    /**
     * @var int
     */
    public $recognizer_id;

    public function initialize()
    {
        parent::initialize();

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
    }
}
