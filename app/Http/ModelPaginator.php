<?php

namespace App\Http;

use App\Http\Response\DataInterface;

class ModelPaginator extends \Phalcon\Paginator\Adapter\Model implements DataInterface
{
    public function getPaginationInfo()
    {
        $paginate = parent::getPaginate();
        unset($paginate->items);

        return $paginate;
    }

    public function getData()
    {
        $paginate = parent::getPaginate();

        return $paginate->items;
    }
}
