<?php

namespace App\Db\Seeds\Models\Relationships;

use App\Models\Degree;
use App\Db\Seeds\Models\BaseSeeder;
use App\Models\Student;

class StudentEnrolledDegreeSeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'            => 1,
            'student_id'    => 1,
            'degree_id'     => 1
        ],
        [
            'id'            => 2,
            'student_id'    => 2,
            'degree_id'     => 2
        ]
    ];

    protected static $extra_seeds = [
        [
            'student_id'    => 1,
            'degree_id'     => 2
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
            'student_id'    => $faker->numberBetween(1, Student::count()),
            'degree_id'     => $faker->numberBetween(1, Degree::count())
        ];
    }
}
