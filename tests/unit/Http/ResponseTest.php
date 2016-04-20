<?php

namespace Http;

use App\Http\Response;

class ResponseTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var Response
     */
    public $response;

    protected function _before()
    {
        $this->response = new Response();
    }

    protected function _after()
    {
        unset($this->response);
    }

    public function testContentTypeIsJsonUTF8()
    {
        $content_type = $this->response->getHeaders()->get('Content-Type');
        $expected = 'application/json; charset=UTF-8';
        $this->tester->assertEquals($expected, $content_type, 'Content type differs from JSON or empty');
    }
}
