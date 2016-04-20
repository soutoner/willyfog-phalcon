<?php

namespace App\Db\Seeds\Models;

class AdminSeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'        => 1,
            'email'     => 'admin@example.com',
            'digest'    => 'foo'
        ],
        [
            'id'        => 2,
            'email'     => 'admin2@example.com',
            'digest'    => 'foo'
        ]
    ];

    protected static $extra_seeds = [
        [
            'email'     => 'newadmin@example.com',
            'digest'    => 'new'
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
            'email'         => $faker->unique()->email,
            'digest'        => 'foo'
        ];
    }
}
