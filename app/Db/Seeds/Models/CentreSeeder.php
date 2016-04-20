<?php

namespace App\Db\Seeds\Models;

use App\Models\City;

class CentreSeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'            => 1,
            'name'          => 'Universida de Malaga',
            'city_id'       => 1
        ],
        [
            'id'            => 2,
            'name'          => 'High School Primary',
            'city_id'       => 2
        ]
    ];

    protected static $extra_seeds = [
        [
            'name'          => 'Test University',
            'city_id'       => 1
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
            'name'          => $faker->name . $faker->randomNumber(4),
            'city_id'       => $faker->numberBetween(1, City::count())
        ];
    }
}
