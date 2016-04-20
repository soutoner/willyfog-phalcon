<?php

namespace App\Db\Seeds\Models;

class ProfessorSeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'                => 1,
            'name'              => 'Jhonny',
            'surname'           => 'Enseño',
            'nif'               => '22345234K',
            'email'             => 'jhonny@university.com',
            'coordinator_id'    => null,
            'recognizer_id'     => 1
        ],
        [
            'id'                => 2,
            'name'              => 'Jhosy',
            'surname'           => 'Enseñaba',
            'nif'               => '22345234L',
            'email'             => 'jhosy@university.com',
            'coordinator_id'    => 1,
            'recognizer_id'     => null
        ]
    ];

    protected static $extra_seeds = [
        [
            'name'              => 'Morcilla',
            'surname'           => 'Fresca Burgos',
            'nif'               => '54119324L',
            'email'             => 'morci@lla.com',
            'coordinator_id'    => 2,
            'recognizer_id'     => null
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
            'name'              => $faker->name,
            'surname'           => $faker->lastName,
            'nif'               => $faker->randomNumber(8) . $faker->randomLetter,
            'email'             => $faker->email
            // Coordinator and recognizer must be declared by hand. Otherwise, lots of seeds will fail
//            'coordinator_id'    => $faker->optional()->numberBetween($min = 1, $max = Coordinator::count()),
//            'recognizer_id'     => $faker->optional()->numberBetween($min = 1, $max = Recognizer::count())
        ];
    }
}
