<?php

namespace App\Db\Seeds\Models;

class RecognizerSeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'        => 1
        ],
        [
            'id'        => 2
        ]
    ];

    protected static $extra_seeds = [];

    /**
     * Generate fake parameters.
     *
     * @param $faker
     *
     * @return array
     */
    public static function GenerateFake(\Faker\Generator $faker)
    {
        return [];
    }
}
