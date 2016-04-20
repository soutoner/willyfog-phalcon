<?php

namespace App\Db\Seeds\Models;

use App\Models\Recognizer;
use App\Models\Student;

class RequestSeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'            => 1,
            'student_id'    => 1,
            'recognizer_id' => 1
        ],
        [
            'id'            => 2,
            'student_id'    => 1,
            'recognizer_id' => 2
        ]
    ];

    protected static $extra_seeds = [
        [
            'student_id'    => 1,
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
            'student_id'    => $faker->numberBetween($min = 1, $max = Student::count()),
            'recognizer_id' => $faker->optional()->numberBetween($min = 1, $max = Recognizer::count())
        ];
    }
}
