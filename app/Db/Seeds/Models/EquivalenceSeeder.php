<?php

namespace App\Db\Seeds\Models;

use App\Models\Subject;

class EquivalenceSeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'                    => 1,
            'subject_id'            => 1,
            'subject_id_eq'         => 2
        ]
    ];

    protected static $extra_seeds = [
        [
            'subject_id'            => 2,
            'subject_id_eq'         => 1
        ]
    ];

    /**
     * Generate fake parameters.
     *
     * @param \Faker\Factory $faker
     *
     * @return array
     */
    public static function GenerateFake(\Faker\Generator $faker)
    {
        return [
            'subject_id'            => $faker->numberBetween($min = 1, $max = Subject::count()),
            'subject_id_eq'         => $faker->numberBetween($min = 1, $max = Subject::count())
        ];
    }
}
