<?php

namespace App\Models;

use Phalcon\Mvc\Model\Validator\Email;
use Phalcon\Mvc\Model\Validator\StringLength;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class Admin extends BaseModel
{
    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $digest;

    public function initialize()
    {
        parent::initialize();

        $this->hasMany('id', 'App\Models\LogGrant', 'log_grant_id', ['alias' => 'LogGrants']);
    }

    public function validation()
    {
        $this->validate(new StringLength([
            'field' => 'email',
            'max'   => 45
        ]));

        $this->validate(new Uniqueness([
            'field' => 'email'
        ]));

        $this->validate(new Email([
            'field' => 'email'
        ]));

        $this->validate(new StringLength([
            'field' => 'digest',
            'max'   => 45
        ]));

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
