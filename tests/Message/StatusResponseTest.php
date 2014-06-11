<?php

namespace Omnipay\GoCoin\Message;

use Omnipay\Tests\TestCase;

class StatusResponseTest extends TestCase
{
    public function testSuccess()
    {
        $httpResponse = $this -> getMockHttpResponse('StatusSuccess.txt');
        $response = new StatusResponse($this -> getMockRequest(), $httpResponse);

        $this -> assertTrue($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertNull($response -> getMessage());
        $this -> assertNotNull($response -> getTransactionReference());
    }

    public function testFailure()
    {
        $httpResponse = $this -> getMockHttpResponse('StatusFailure.txt');
        $response = new StatusResponse($this -> getMockRequest(), $httpResponse);

        $this -> assertFalse($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
    }

    public function testEmpty()
    {
        $response = new StatusResponse($this -> getMockRequest(), array());

        $this -> assertFalse($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertNull($response -> getTransactionReference());
        $this -> assertNull($response -> getMessage());
    }
}
