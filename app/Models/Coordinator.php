<?php

namespace App\Models;

class Coordinator extends BaseModel
{
    public function initialize()
    {
        parent::initialize();

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\CoordinatorCoordCentre',
            'coordinator_id',
            'centre_id',
            'App\Models\Centre',
            'id',
            ['alias' => 'CentresCoordinates']
        );

        $this->hasOne(
            'id',
            'App\Models\Professor',
            'coordinator_id',
            ['alias' => 'Professor']
        );
    }
}
