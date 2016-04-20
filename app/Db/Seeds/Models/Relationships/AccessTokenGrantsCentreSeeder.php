<?php

namespace App\Db\Seeds\Models\Relationships;

use App\Db\Seeds\Models\BaseSeeder;
use App\Models\AccessToken;
use App\Models\Centre;

class AccessTokenGrantsCentreSeeder extends BaseSeeder
{
    protected static $db_seeds = [
        [
            'id'                => 1,
            'access_token_id'   => 1,
            'centre_id'         => 1
        ],
        [
            'id'                => 2,
            'access_token_id'   => 2,
            'centre_id'         => 2
        ]
    ];

    protected static $extra_seeds = [
        [
            'access_token_id'   => 1,
            'centre_id'         => 2
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
            'access_token_id'   => $faker->numberBetween(1, AccessToken::count()),
            'centre_id'         => $faker->numberBetween(1, Centre::count())
        ];
    }
}
