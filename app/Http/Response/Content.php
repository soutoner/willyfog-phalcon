<?php

namespace App\Http\Response;

/**
 * Content of a Response.
 *
 * Class Content
 */
class Content implements \JsonSerializable
{
    /**
     * Meta data of the response.
     *
     * @var Meta
     */
    public $meta;

    /**
     * Raw data of the response.
     *
     * @var DataInterface
     */
    public $data;

    /**
     * Pagination data if necessary.
     *
     * @var array
     */
    public $pagination;

    public function __construct($content = null)
    {
        $this->setData($content);
        $this->meta = new Meta();
    }

    /**
     * Set meta status code and message.
     *
     * @param $code
     * @param null $message
     *
     * @throws \Exception
     *
     * @return null|string
     */
    public function setStatusCode($code, $message = null)
    {
        $this->meta->setStatusCode($code, $message);
    }

    public function setErrorType($error_type)
    {
        $this->meta->setErrorType($error_type);
    }

    /**
     * @param $content
     *
     * @throws \Exception
     */
    public function setData($content)
    {
        if (is_object($content)) {
            if (!$content instanceof DataInterface) {
                throw new \Exception('Content must implement DataInterface');
            } else {
                $this->setPagination($content->getPaginationInfo());
                $content = $content->getData();
            }
        }

        $this->data = $content;
    }

    public function setJsonContent($content, $jsonOptions = 0, $depth = 512)
    {
        $this->data = $content;
    }

    /**
     * TODO: implement correctly.
     *
     * @param $content
     */
    public function appendContent($content)
    {
        $this->data = array_combine($this->data, $content);
    }

    /**
     * @param $pagination
     */
    public function setPagination($pagination)
    {
        $this->pagination = $pagination;
    }

    /**
     * Specify data which should be serialized to JSON.
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed data which can be serialized by <b>json_encode</b>,
     *               which is a value of any type other than a resource.
     *
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return array_filter(get_object_vars($this));
    }

    public function __toString()
    {
        return json_encode($this);
    }
}
