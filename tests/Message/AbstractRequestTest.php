<?php

namespace Omnipay\GoCoin\Message;

use Mockery as m;
use Omnipay\Tests\TestCase;

class AbstractRequestTest extends TestCase
{
    public function setUp()
    {
        $this->request = m::mock('\Omnipay\GoCoin\Message\AbstractRequest')->makePartial();
        $this->request->initialize();
    }

    public function testDoNothing()
    {
        //make phpunit happy
    }
}
