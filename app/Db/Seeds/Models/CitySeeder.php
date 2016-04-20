<?php

namespace App\Db\Seeds\Models;

use App\Models\Country;

class CitySeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'            => 1,
            'name'          => 'Malaga',
            'country_id'    => 1
        ],
        [
            'id'            => 2,
            'name'          => 'Springfield',
            'country_id'    => 2
        ]
    ];

    protected static $extra_seeds = [
        [
            'name'          => 'Sevilla',
            'country_id'    => 1
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
            'name'          => $faker->city . $faker->randomNumber(4),
            'country_id'    => $faker->numberBetween(1, Country::count())
        ];
    }
}
