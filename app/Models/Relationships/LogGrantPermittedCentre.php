<?php

namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class LogGrantPermittedCentre extends BaseModel
{
    /**
     * @var int
     */
    public $log_grant_id;

    /**
     * @var int
     */
    public $centre_id;

    public function initialize()
    {
        $this->belongsTo(
            'log_grant_id',
            'App\Models\LogGrant',
            'id',
            [
                'alias'      => 'LogGrant',
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
            'field' => ['log_grant_id', 'centre_id']
        ]));

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
