<?php

namespace Omnipay\GoCoin\Message;

use Omnipay\Tests\TestCase;

class PurchaseResponseTest extends TestCase
{
    public function testSuccess()
    {
        $httpResponse = $this -> getMockHttpResponse('PurchaseSuccess.txt');
        $response = new PurchaseResponse($this -> getMockRequest(), $httpResponse);

        $this -> assertTrue($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertNull($response -> getMessage());
        $this -> assertNotNull($response -> getTransactionReference());
    }

    public function testFailure()
    {
        $httpResponse = $this -> getMockHttpResponse('PurchaseFailure.txt');
        $response = new PurchaseResponse($this -> getMockRequest(), $httpResponse);

        $this -> assertFalse($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertNull($response -> getTransactionReference());
    }

    public function testEmpty()
    {
        $response = new PurchaseResponse($this -> getMockRequest(), array());

        $this -> assertFalse($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertNull($response -> getTransactionReference());
        $this -> assertNull($response -> getMessage());
    }
}
