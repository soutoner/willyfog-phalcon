<?php

namespace App\Db\Seeds\Models;

use App\Models\Degree;
use App\Models\Recognizer;

class SubjectSeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'            => 1,
            'name'          => 'Calculo de manzanas',
            'degree_id'     => 1,
            'recognizer_id' => 1
        ],
        [
            'id'            => 2,
            'name'          => 'Integrales de pan',
            'degree_id'     => 1,
            'recognizer_id' => null
        ]
    ];

    protected static $extra_seeds = [
        [
            'name'          => 'Testing',
            'degree_id'     => 1,
            'recognizer_id' => 1
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
            'name'          => $faker->name . $faker->randomNumber(5),
            'degree_id'     => $faker->numberBetween($min = 1, $max = Degree::count()),
            'recognizer_id' => $faker->optional()->numberBetween($min = 1, $max = Recognizer::count())
        ];
    }
}
