<?php


namespace App\Models;

use Phalcon\Mvc\Model\Validator\StringLength;

class Recognizer extends BaseModel
{
    public function initialize()
    {
        parent::initialize();

        $this->hasMany(
            'id',
            'App\Models\Login',
            'login_id',
            ['alias' => 'Logins']
        );
    }

    public function validation()
    {
        $this->validate(new StringLength([
            'field' => 'name',
            'max'   => 25
        ]));

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}