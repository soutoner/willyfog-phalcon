<?php

namespace App\Db\Seeds\Models;

use App\Models\Centre;

class DegreeSeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'        => 1,
            'name'      => 'Ingenieria de lavadoras',
            'centre_id' => 2
        ],
        [
            'id'        => 2,
            'name'      => 'Caracoles science',
            'centre_id' => 1
        ]
    ];

    protected static $extra_seeds = [
        [
            'name'      => 'Testing Degree',
            'centre_id' => 1
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
            'name'      => $faker->unique()->streetName,
            'centre_id' => $faker->numberBetween($min = 1, $max = Centre::count())
        ];
    }
}
