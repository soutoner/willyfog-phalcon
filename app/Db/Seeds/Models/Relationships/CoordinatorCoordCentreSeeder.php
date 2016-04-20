<?php

namespace App\Db\Seeds\Models\Relationships;

use App\Db\Seeds\Models\BaseSeeder;
use App\Models\Centre;
use App\Models\Coordinator;

class CoordinatorCoordCentreSeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'                => 1,
            'coordinator_id'    => 1,
            'centre_id'         => 1
        ],
        [
            'id'                => 2,
            'coordinator_id'    => 2,
            'centre_id'         => 2
        ]
    ];

    protected static $extra_seeds = [
        [
            'coordinator_id'    => 2,
            'centre_id'         => 1
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
            'coordinator_id'    => $faker->numberBetween($min = 1, $max = Coordinator::count()),
            'centre_id'         => $faker->numberBetween($min = 1, $max = Centre::count())
        ];
    }
}
