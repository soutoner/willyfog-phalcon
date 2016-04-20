<?php

namespace App\Models;

use Phalcon\Mvc\Model\Validator\StringLength;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class AccessToken extends BaseModel
{
    /**
     * @var string
     */
    public $access_token;

    public function initialize()
    {
        parent::initialize();

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\AccessTokenGrantsCentre',
            'access_token_id',
            'centre_id',
            'App\Models\Centre',
            'id',
            ['alias' => 'CentresGranted']
        );
    }

    public function validation()
    {
        $this->validate(new StringLength([
            'field' => 'access_token',
            'max'   => 45
        ]));

        $this->validate(new Uniqueness([
            'field' => 'access_token'
        ]));

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
