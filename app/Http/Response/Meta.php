<?php

namespace App\Http\Response;

use Exception;

/**
 * Meta data part of the content of a Response.
 *
 * Class Meta
 */
class Meta implements \JsonSerializable
{
    /**
     * HTTP status code.
     *
     * @var int
     */
    public $code;

    /**
     * Status description message.
     *
     * @var string
     */
    public $message;

    /**
     * Error type if present.
     *
     * @var string
     */
    public $error_type;

    /**
     * Set status code.
     *
     * @param $code
     * @param null $message
     *
     * @throws Exception
     *
     * @return null|string
     */
    public function setStatusCode($code, $message = null)
    {
        if ($code === null) {
            $code = 200;
        }
        $this->code = $code;

        // if an empty message is given we try and grab the default for this
        // status code. If a default doesn't exist, stop here.
        if ($message === null) {
            $statusCodes = [
                // INFORMATIONAL CODES
                100 => 'Continue',
                101 => 'Switching Protocols',
                102 => 'Processing',
                // SUCCESS CODES
                200 => 'OK',
                201 => 'Created',
                202 => 'Accepted',
                203 => 'Non-Authoritative Information',
                204 => 'No Content',
                205 => 'Reset Content',
                206 => 'Partial Content',
                207 => 'Multi-status',
                208 => 'Already Reported',
                226 => 'IM Used',
                // REDIRECTION CODES
                300 => 'Multiple Choices',
                301 => 'Moved Permanently',
                302 => 'Found',
                303 => 'See Other',
                304 => 'Not Modified',
                305 => 'Use Proxy',
                306 => 'Switch Proxy', // Deprecated
                307 => 'Temporary Redirect',
                308 => 'Permanent Redirect',
                // CLIENT ERROR
                400 => 'Bad Request',
                401 => 'Unauthorized',
                402 => 'Payment Required',
                403 => 'Forbidden',
                404 => 'Not Found',
                405 => 'Method Not Allowed',
                406 => 'Not Acceptable',
                407 => 'Proxy Authentication Required',
                408 => 'Request Time-out',
                409 => 'Conflict',
                410 => 'Gone',
                411 => 'Length Required',
                412 => 'Precondition Failed',
                413 => 'Request Entity Too Large',
                414 => 'Request-URI Too Large',
                415 => 'Unsupported Media Type',
                416 => 'Requested range not satisfiable',
                417 => 'Expectation Failed',
                418 => "I'm a teapot",
                421 => 'Misdirected Request',
                422 => 'Unprocessable Entity',
                423 => 'Locked',
                424 => 'Failed Dependency',
                425 => 'Unordered Collection',
                426 => 'Upgrade Required',
                428 => 'Precondition Required',
                429 => 'Too Many Requests',
                431 => 'Request Header Fields Too Large',
                451 => 'Unavailable For Legal Reasons',
                499 => 'Client Closed Request',
                // SERVER ERROR
                500 => 'Internal Server Error',
                501 => 'Not Implemented',
                502 => 'Bad Gateway',
                503 => 'Service Unavailable',
                504 => 'Gateway Time-out',
                505 => 'HTTP Version not supported',
                506 => 'Variant Also Negotiates',
                507 => 'Insufficient Storage',
                508 => 'Loop Detected',
                511 => 'Network Authentication Required'
            ];

            if (!isset($statusCodes[$code])) {
                throw new Exception('Non-standard statuscode given without a message');
            }

            $defaultMessage = $statusCodes[$code];
            $message = $defaultMessage;
        }

        $this->message = $message;
    }

    public function setErrorType($error_type)
    {
        $this->error_type = $error_type;
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
}
