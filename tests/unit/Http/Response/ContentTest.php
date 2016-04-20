<?php

namespace Http\Response;

use App\Http\Response\Content;

class ContentTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var Content
     */
    public $content;

    protected function _before()
    {
        $this->content = new Content();
    }

    protected function _after()
    {
        unset($this->content);
    }

    public function testContentAcceptNonObjects()
    {
        $this->tester->assertFalse(
            $this->tester->seeExceptionThrown(function () {
                $this->content->setData('hola');
                $this->content->setData(['hola' => 'kase']);
            })
        );
    }

    public function testObjectContentMustImplementInterface()
    {
        $this->tester->assertTrue(
            $this->tester->seeExceptionThrown(function () {
                $this->content->setData((object) ['falseObject']);
            })
        );
    }
}
