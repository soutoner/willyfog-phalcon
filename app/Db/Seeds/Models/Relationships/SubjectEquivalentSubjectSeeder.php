<?php

namespace App\Db\Seeds\Models\Relationships;

use App\Models\Subject;
use App\Db\Seeds\Models\BaseSeeder;

class SubjectEquivalentSubjectSeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'                    => 1,
            'subject_id'            => 1,
            'subject_id_eq'         => 1
        ],
        [
            'id'                    => 2,
            'subject_id'            => 2,
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
     * @param $faker
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
