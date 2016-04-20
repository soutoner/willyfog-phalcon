<?php

namespace App\Db\Seeds\Models;

use App\Models\Admin;

class LogGrantSeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'        => 1,
            'admin_id'  => 1
        ],
        [
            'id'        => 2,
            'admin_id'  => 2
        ]
    ];

    protected static $extra_seeds = [
        [
            'admin_id'  => 1
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
            'admin_id' => $faker->numberBetween($min = 1, $max = Admin::count())
        ];
    }
}
