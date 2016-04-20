<?php

namespace App\Models\Relationships;

use App\Models\BaseModel;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class CoordinatorCoordCentre extends BaseModel
{
    /**
     * @var int
     */
    public $coordinator_id;

    /**
     * @var int
     */
    public $centre_id;

    public function initialize()
    {
        $this->belongsTo(
            'coordinator_id',
            'App\Models\Coordinator',
            'id',
            [
                'alias'      => 'Coordinator',
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
            'field' => ['coordinator_id', 'centre_id']
        ]));

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
