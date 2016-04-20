<?php

namespace App\Models;

use Phalcon\Mvc\Model\Validator\StringLength;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class City extends BaseModel
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $country_id;

    public function initialize()
    {
        parent::initialize();

        $this->hasMany('id', 'App\Models\Centre', 'centre_id', ['alias' => 'Centres']);

        $this->belongsTo(
            'country_id',
            'App\Models\Country',
            'id',
            [
                'alias'      => 'Country',
                'foreignKey' => true
            ]
        );
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
