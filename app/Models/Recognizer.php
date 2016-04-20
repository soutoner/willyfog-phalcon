<?php

namespace App\Models;

class Recognizer extends BaseModel
{
    public function initialize()
    {
        parent::initialize();

        $this->hasMany(
            'id',
            'App\Models\Subject',
            'subject_id',
            ['alias' => 'Subjects']
        );

        $this->hasOne(
            'id',
            'App\Models\Professor',
            'coordinator_id',
            ['alias' => 'Professor']
        );
    }
}
