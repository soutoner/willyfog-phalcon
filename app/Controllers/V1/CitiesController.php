<?php

namespace App\Controllers\V1;

use App\Controllers\BaseController;
use App\Http\Response;
use App\Models\City;
use App\Exceptions\ResourceNotFoundException;

class CitiesController extends BaseController
{
    public function index()
    {
        return $this->paginate(City::find());
    }

    public function create()
    {
        $request = $this->request;

        $this->model = new City();
        $this->model->assign([
            'name'          => $request->get('name', 'string'),
            'country_id'    => $request->get('country_id', 'int')
        ]);

        return $this->response();
    }

    public function update($id)
    {
        $id = $this->filter->sanitize($id, 'int');

        try {
            $request = $this->request;
            $this->model = City::findFirstOrFail([
                'id = ?0', 'bind' => [$id]
            ]);
            $this->model->assign([
                'id'                => $id,
                'name'              => $request->getPut('name', 'string', $this->model->name),
                'country_id'        => $request->getPut('desc', 'string', $this->model->country_id)
            ]);

            return $this->response();
        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }

    public function delete($id)
    {
        $id = $this->filter->sanitize($id, 'int');

        try {
            $this->model = City::findFirstOrFail([
                'id = ?0', 'bind' => [$id]
            ]);

            return $this->response();
        } catch (ResourceNotFoundException $e) {
            return $e->returnResponse();
        }
    }
}
