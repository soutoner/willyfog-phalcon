<?php

namespace App\Models;

class LogGrant extends BaseModel
{
    /**
     * @var int
     */
    public $admin_id;

    public function initialize()
    {
        parent::initialize();

        $this->belongsTo(
            'admin_id',
            'App\Models\Admin',
            'id',
            [
                'alias'      => 'Admin',
                'foreignKey' => true
            ]
        );

        $this->hasManyToMany(
            'id',
            'App\Models\Relationships\LogGrantPermittedCentre',
            'log_grant_id',
            'centre_id',
            'App\Models\Centre',
            'id',
            ['alias' => 'CentresPermitted']
        );
    }
}
