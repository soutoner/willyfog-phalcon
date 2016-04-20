<?php

namespace App\Http;

use App\Http\Response\Content;
use Exception;

/**
 * Class Response.
 */
class Response extends \Phalcon\Http\Response
{
    /**
     * HTTP version.
     *
     * @var string
     */
    public $version = '1.1';

    /**
     * Content of the response.
     *
     * @var Content
     */
    public $content;

    /**
     * Phalcon\Http\Response constructor.
     *
     * @param string $content
     * @param int    $code
     * @param string $message
     */
    public function __construct($content = null, $code = null, $message = null)
    {
        $this->content = new Content($content);
        $this->setStatusCode($code, $message);
        // By default JSON content type and UTF-8 charset
        $this->setContentType('application/json', 'UTF-8');
    }

    /**
     * Sets the HTTP response code.
     *
     * @param int    $code
     * @param string $message
     *
     * @throws Exception
     *
     * @return \Phalcon\Http\ResponseInterface
     */
    public function setStatusCode($code, $message = null)
    {
        $headers = $this->getHeaders();
        $currentHeadersRaw = $headers->toArray();

        /**
         * We use HTTP/<version>.
         *
         * Before that we would like to unset any existing HTTP/x.y headers
         */
        if (is_array($currentHeadersRaw)) {
            foreach ($currentHeadersRaw as $key => $_) {
                if (is_string($key) && strstr($key, 'HTTP/')) {
                    $headers->remove($key);
                }
            }
        }

        $this->content->setStatusCode($code, $message);

        $code = $this->content->meta->code;
        $message = $this->content->meta->message;

        $headers->setRaw("HTTP/$this->version " . $code . ' ' . $message);

        /**
         * We also define a 'Status' header with the HTTP status.
         */
        $headers->set('Status', $code . ' ' . $message);

        return $this;
    }

    public function setErrorType($error_type)
    {
        $this->content->setErrorType($error_type);
    }

    /**
     * Sets HTTP response body.
     *
     * @param string $content
     *
     * @return \Phalcon\Http\ResponseInterface
     */
    public function setContent($content)
    {
        $this->content->setData($content);

        return $this;
    }

    /**
     * Sets HTTP response body. The parameter is automatically converted to JSON
     * <code>
     * response->setJsonContent(array("status" => "OK"));
     * </code>.
     *
     * @param string $content
     * @param int    $jsonOptions
     * @param int    $depth
     *
     * @return \Phalcon\Http\ResponseInterface
     */
    public function setJsonContent($content, $jsonOptions = 0, $depth = 512)
    {
        $this->content->setJsonContent($content, $jsonOptions, $depth);

        return $this;
    }

    /**
     * Gets the HTTP response body.
     *
     * @return string
     */
    public function getContent()
    {
        return (string) $this->content;
    }

    /**
     * Prints out HTTP response to the client.
     *
     * @throws Exception
     *
     * @return \Phalcon\Http\ResponseInterface
     */
    public function send()
    {
        if ($this->_sent) {
            throw new Exception('Response was already sent');
        }

        /**
         * Send headers.
         */
        $headers = $this->_headers;
        if (is_object($headers)) {
            $headers->send();
        }

        /**
         * Send Cookies/comment.
         */
        $cookies = $this->_cookies;
        if (is_object($cookies)) {
            $cookies->send();
        }

        /**
         * Output the response body.
         */
        $content = $this->content;
        if ($content != null) {
            echo json_encode($content, JSON_PRETTY_PRINT);
        } else {
            $file = $this->_file;

            if (is_string($file) && strlen($file)) {
                readfile($file);
            }
        }

        $this->sent = true;

        return $this;
    }

    /**
     * Appends a string to the HTTP response body.
     *
     * @param string $content
     *
     * @return \Phalcon\Http\ResponseInterface
     */
    public function appendContent($content)
    {
        $this->content->appendContent($content);
    }

    /**
     * Creates Response from OAuth2\Response.
     *
     * @param \OAuth2\Response $oauth_response
     *
     * @return Response
     */
    public static function createFromOAuth(\OAuth2\Response $oauth_response)
    {
        $response = new self();

        $oauth_code = $oauth_response->getStatusCode();
        $oauth_status = $oauth_response->getStatusText();
        $oauth_headers = $oauth_response->getHttpHeaders();
        $oauth_parameters = $oauth_response->getParameters();

        $headers = $response->getHeaders();
        foreach ($oauth_headers as $key => $value) {
            $headers->set($key, $value);
        }

        if (!empty($oauth_parameters)) {
            $response->setContent($oauth_parameters);
        }

        $response->setStatusCode($oauth_code, $oauth_status);
        $response->setHeaders($headers);

        return $response;
    }
}
