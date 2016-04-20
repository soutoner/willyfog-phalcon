<?php


namespace App\Models;

class Recognizer extends BaseModel
{
    public function initialize()
    {
        parent::initialize();

        $this->belongsTo(
            'admin_id',
            'App\Models\Admin',
            'id',
            [
                'alias' => 'Admin',
                'foreignKey' => [
                    'allowNulls' => true
                ]
            ]
        );

        $this->belongsTo(
            'student_id',
            'App\Models\Student',
            'id',
            [
                'alias' => 'Student',
                'foreignKey' => [
                    'allowNulls' => true
                ]
            ]
        );

        $this->belongsTo(
            'professor_id',
            'App\Models\Professor',
            'id',
            [
                'alias' => 'Professor',
                'foreignKey' => [
                    'allowNulls' => true
                ]
            ]
        );

        $this->belongsTo(
            'role_id',
            'App\Models\Role',
            'id',
            [
                'alias' => 'Role'
            ]
        );
    }
}