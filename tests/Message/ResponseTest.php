<?php

namespace Omnipay\GoCoin\Message;

use Omnipay\Tests\TestCase;

class ResponseTest extends TestCase
{
    public function testSuccess()
    {
        $httpResponse = $this -> getMockHttpResponse('StatusSuccess.txt');
        $response = new Response($this -> getMockRequest(), $httpResponse);

        $this -> assertTrue($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        //$this -> assertSame('completed', $response -> getMessage());
        //$this -> assertSame('9XMWP4YG', $response -> getTransactionReference());
    }

    public function testFailure()
    {
        $httpResponse = $this -> getMockHttpResponse('StatusFailure.txt');
        $response = new Response($this -> getMockRequest(), $httpResponse);

        $this -> assertFalse($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        //$this -> assertSame('Order not found with that id', $response -> getMessage());
        //$this -> assertNull($response -> getTransactionReference());
    }

    public function testEmpty()
    {
        $response = new Response($this -> getMockRequest(), array());

        $this -> assertFalse($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertNull($response -> getTransactionReference());
        $this -> assertNull($response -> getMessage());
    }
}
