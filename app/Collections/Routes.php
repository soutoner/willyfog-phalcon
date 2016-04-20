<?php

namespace App\Collections;

use App\Collections\V1\CitiesCollection;
use App\Collections\V1\TokenCollection;

class Routes
{
    /**
     * Returns RouteCollections to be mounted in the app.
     *
     * @return array
     */
    public static function getRoutes()
    {
        return [
            CitiesCollection::getCollection(),
            TokenCollection::getCollection()
        ];
    }
}
