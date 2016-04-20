<?php

namespace Http\Response;

use App\Http\Response\Meta;

class MetaTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var Meta
     */
    public $meta;

    protected function _before()
    {
        $this->meta = new Meta();
    }

    protected function _after()
    {
        unset($this->meta);
    }

    public function testDefaultCode200()
    {
        $this->meta->setStatusCode(null);
        $this->tester->assertEquals(200, $this->meta->code);
    }

    public function testNonStandardCodeWithoutMessageThrowsException()
    {
        $this->tester->assertTrue(
            $this->tester->seeExceptionThrown(function () {
                $this->meta->setStatusCode(1020);
            })
        );
    }
}
