<?php

namespace App\Models;

use Phalcon\Mvc\Model\Validator\StringLength;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class Country extends BaseModel
{
    /**
     * @var string
     */
    public $name;

    public function initialize()
    {
        parent::initialize();

        $this->hasMany('id', 'App\Models\City', 'city_id', ['alias' => 'Cities']);
    }

    public function validation()
    {
        $this->validate(new StringLength([
            'field' => 'name',
            'max'   => 120
        ]));

        $this->validate(new Uniqueness([
            'field' => 'name'
        ]));

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
