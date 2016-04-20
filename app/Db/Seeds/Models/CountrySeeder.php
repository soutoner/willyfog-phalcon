<?php

namespace App\Db\Seeds\Models;

class CountrySeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'    => 1,
            'name'  => 'España'
        ],
        [
            'id'    => 2,
            'name'  => 'Neverland'
        ]
    ];

    protected static $extra_seeds = [
        [
            'name'  => 'Marruecos'
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
            'name'  => $faker->country . $faker->randomNumber(4)
        ];
    }
}
