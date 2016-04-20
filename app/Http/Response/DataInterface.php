<?php

namespace App\Http\Response;

interface DataInterface
{
    /**
     * Return actual data to be hold by the response.
     *
     * @return \stdClass | array
     */
    public function getData();

    /**
     * Return pagination info if available.
     *
     * @return \stdClass | array
     */
    public function getPaginationInfo();
}
