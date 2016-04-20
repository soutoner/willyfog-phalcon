<?php

namespace App\Db\Seeds\Models;

class AccessTokenSeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'            => 1,
            'access_token'  => 'asdasdas'
        ],
        [
            'id'            => 2,
            'access_token'  => 'asddsfsdgdf'
        ]
    ];

    protected static $extra_seeds = [
        [
            'access_token'  => 'accesstoken1233$%&'
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
            'access_token' => $faker->md5
        ];
    }
}
