<?php

namespace App\Collections;

use App\Helpers\Strings\NameHelper;
use Phalcon\Mvc\Micro\Collection;

abstract class RouteCollection
{
    /**
     * Phalcon MicroCollection that holds all the info about routes.
     *
     * @var \Phalcon\Mvc\Micro\Collection
     */
    protected $collection;

    /**
     * Version of the endpoint.
     *
     * @var string
     */
    protected $version = null;

    /**
     * Name of the endpoint.
     *
     * @var string
     */
    protected $endpoint = null;

    /**
     * Name of the controller that handles the endpoint.
     *
     * @var string
     */
    protected $controller = null;

    public function __construct()
    {
        $collection_name = get_called_class();
        $this->collection = new Collection();
        // If no attributes are given, infer from folder structure and names
        if ($this->version === null) {
            $this->version = NameHelper::versionFromClassName($collection_name);
        }
        if ($this->endpoint === null) {
            $this->endpoint = strtolower(NameHelper::namespaceToClassName($collection_name, 'Collection'));
        }
        if ($this->controller === null) {
            $this->controller = NameHelper::namespaceToClassName($collection_name, 'Collection', 'Controller');
        }

        $this->collection->setHandler("App\\Controllers\\$this->version\\$this->controller", true);
        $version = strtolower($this->version);
        $this->collection->setPrefix("/$version/$this->endpoint");
    }

    /**
     * Define in this method the routes of the endpoint.
     *
     * Don't forget to add the collection to Routes.php.
     *
     * @param Collection $collection
     *
     * @return mixed
     */
    abstract public function defineRoutes(\Phalcon\Mvc\Micro\Collection $collection);

    /**
     * Returns the actual MicroCollection.
     *
     * @return \Phalcon\Mvc\Micro\Collection
     */
    public static function getCollection()
    {
        $class = get_called_class();
        $object = new $class();
        // Define user-entered routes
        $object->defineRoutes($object->collection);

        return $object->collection;
    }
}
