<?php

namespace App\Exceptions;

use App\Http\Response;
use App\Helpers\Strings\NameHelper;

abstract class Exception extends \Exception
{
    /**
     * HTTP code associated to the exception.
     *
     * @var int
     */
    public $code;

    /**
     * Description of the error.
     *
     * @var string
     */
    public $message;

    /**
     * Type of the exception (class name).
     *
     * @var string
     */
    public $type;

    public function __construct($message = 'Internal server exception', $code = 500, $previous = null)
    {
        parent::__construct($message, $code, null);
        $this->code = $code;
        $this->message = $message;
        $this->type = NameHelper::namespaceToClassName(get_called_class());
    }

    public function returnResponse()
    {
        $response = new Response();
        $response->setStatusCode($this->code, $this->message);
        $response->setErrorType($this->type);

        return $response;
    }
}
