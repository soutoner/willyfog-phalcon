<?php

namespace App\Models;

use Phalcon\Mvc\Model\Validator\StringLength;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class Centre extends BaseModel
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $city_id;

    public function initialize()
    {
        parent::initialize();

        $this->hasMany('id', 'App\Models\Degree', 'centre_id', ['alias' => 'Degrees']);

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\AccessTokeGrantsCentre',
            'centre_id',
            'access_token_id',
            'App\Models\AccessToken',
            'id',
            ['alias' => 'GrantedByAccessTokens']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\LogGrantPermittedCentre',
            'centre_id',
            'log_grant_id',
            'App\Models\LogGrant',
            'id',
            ['alias' => 'PermittedByLogGrants']
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\CoordinatorCoordCentre',
            'centre_id',
            'coordinator_id',
            'App\Models\Coordinator',
            'id',
            ['alias' => 'CoordedByCoordinators']
        );

        $this->belongsTo(
            'city_id',
            'App\Models\City',
            'id',
            [
                'alias'      => 'City',
                'foreignKey' => true
            ]
        );
    }

    public function validation()
    {
        $this->validate(new StringLength([
            'field' => 'name',
            'max'   => 100
        ]));

        $this->validate(new Uniqueness([
            'field' => 'name'
        ]));

        if ($this->validationHasFailed() == true) {
            return false;
        }
    }
}
