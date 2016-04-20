<?php

namespace App\Db\Seeds\Models;

class StudentSeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'        => 1,
            'nif'       => '88768907J',
            'name'      => 'Student',
            'surname'   => 'One',
            'email'     => 'one@students.com'
        ],
        [
            'id'        => 2,
            'nif'       => '88768907K',
            'name'      => 'Studento',
            'surname'   => 'Two',
            'email'     => 'two@students.com'
        ]
    ];

    protected static $extra_seeds = [
        [
            'nif'       => '54147962N',
            'name'      => 'Rodolfo',
            'surname'   => 'Muñoz Ortiz',
            'email'     => 'rodolfo.mortiz@gmail.com'
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
            'nif'       => $faker->randomNumber(8) . $faker->randomLetter,
            'name'      => $faker->name,
            'surname'   => $faker->lastName,
            'email'     => $faker->email
        ];
    }
}
