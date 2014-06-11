<?php

namespace Omnipay\GoCoin\Message;

use Omnipay\Tests\TestCase;

class AuthorizeResponseTest extends TestCase
{
    public function testSuccess()
    {
        $httpResponse = $this -> getMockHttpResponse('AuthorizeSuccess.txt');
        $response = new AuthorizeResponse($this -> getMockRequest(), $httpResponse);

        $this -> assertTrue($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertNull($response -> getMessage());
    }

    public function testFailure()
    {
        $httpResponse = $this -> getMockHttpResponse('AuthorizeFailure.txt');
        $response = new AuthorizeResponse($this -> getMockRequest(), $httpResponse);

        $this -> assertFalse($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertNull($response -> getTransactionReference());
    }

    public function testEmpty()
    {
        $response = new AuthorizeResponse($this -> getMockRequest(), array());

        $this -> assertFalse($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertNull($response -> getTransactionReference());
        $this -> assertNull($response -> getMessage());
    }
}
