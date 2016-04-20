<?php

namespace App\Controllers;

use App\Http\ModelPaginator;
use App\Http\Response;
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Model;

class BaseController extends Controller
{
    /**
     * Model of the controller.
     *
     * @var Model
     */
    public $model;

    /**
     * Check if the resource is saved or not and returns a response depending on this.
     *
     * @param $resource Model
     *
     * @return Response
     */
    public function response($resource = null)
    {
        $response = new Response();

        $method = $this->request->getMethod();

        if (null === $resource) {
            $resource = $this->model;
        }

        if ('POST' == $method || 'PUT' == $method) {
            if ($resource->save()) {
                // Change the HTTP status
                if ('POST' == $method) {
                    $response->setStatusCode(201, 'Created');
                } else {
                    $response->setStatusCode(200, 'Updated');
                }
                $response->setContent($resource);
            } else {
                // Change the HTTP status
                $response->setStatusCode(409, 'Conflict');
                // Send errors to the client
                $errors = [];
                foreach ($resource->getMessages() as $message) {
                    $key = $message->getField();
                    if (empty($key)) {
                        $errors[] = $message->getMessage();
                    } else {
                        if (!isset($errors[$key])) {
                            $errors[$key] = [];
                        }
                        $errors[$key][] = $message->getMessage();
                    }
                }
                $response->setContent($errors);
            }
        } else { // DELETE
            if ($resource->delete()) {
                $response->setStatusCode(200, 'Deleted');
            } else {
                // Change the HTTP status
                $response->setStatusCode(409, 'Internal error while deleting');
            }
        }

        return $response;
    }

    /**
     * Paginates given resource.
     *
     * @param $resource
     * @param int $limit
     *
     * @return Response
     */
    public function paginate($resource, $limit = 10)
    {
        $paginator = new ModelPaginator([
            'data'  => $resource,
            'limit' => $limit,
            'page'  => (int) $this->request->getQuery('page', 'int', '1')
        ]);

        return new Response($paginator);
    }
}
