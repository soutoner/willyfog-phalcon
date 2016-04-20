<?php

namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class AccessTokenGrantsCentre extends BaseModel
{
    /**
     * @var int
     */
    public $access_token_id;

    /**
     * @var int
     */
    public $centre_id;

    public function initialize()
    {
        $this->belongsTo(
            'access_token_id',
            'App\Models\AccessToken',
            'id',
            [
                'alias'      => 'AccessToken',
                'foreignKey' => true
            ]
        );

        $this->belongsTo(
            'centre_id',
            'App\Models\Centre',
            'id',
            [
                'alias'      => 'Centre',
                'foreignKey' => true
            ]
        );
    }

    public function validation()
    {
        $this->validate(new Uniqueness([
            'field' => ['access_token_id', 'centre_id']
        ]));

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
