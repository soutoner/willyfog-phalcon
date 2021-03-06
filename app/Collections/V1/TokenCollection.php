<?php

namespace App\Collections\V1;

use App\Collections\RouteCollection;
use Phalcon\Mvc\Micro\Collection;

class TokenCollection extends RouteCollection
{
    protected $endpoint = 'token';

    /**
     * Define in this method the routes of the endpoint.
     *
     * Don't forget to add the collection to Routes.php.
     *
     * @param Collection $collection
     *
     * @return mixed
     */
    public function defineRoutes(\Phalcon\Mvc\Micro\Collection $collection)
    {
        $collection->post('/', 'accessToken');
    }
}
