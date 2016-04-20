<?php

namespace App\Db\Seeds\Models\Relationships;

use App\Models\Centre;
use App\Db\Seeds\Models\BaseSeeder;
use App\Models\LogGrant;

class LogGrantPermittedCentreSeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'                => 1,
            'log_grant_id'      => 1,
            'centre_id'         => 1
        ],
        [
            'id'                => 2,
            'log_grant_id'      => 2,
            'centre_id'         => 2
        ]
    ];

    protected static $extra_seeds = [
        [
            'log_grant_id'      => 1,
            'centre_id'         => 2
        ]
    ];

    /**
     * Generate fake parameters.
     *
     * @param $faker
     *
     * @return array
     */
    public static function GenerateFake(\Faker\Generator $faker)
    {
        return [
            'log_grant_id'  => $faker->numberBetween(1, LogGrant::count()),
            'centre_id'     => $faker->numberBetween(1, Centre::count())
        ];
    }
}
