<?php

namespace Omnipay\GoCoin;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this -> gateway = new Gateway($this -> getHttpClient(), $this -> getHttpRequest());
    }
/*
    public function testPurchase()
    {
        $request = $this -> gateway -> purchase(array('amount' => '10.00'));

        $this -> assertInstanceOf('Omnipay\GoCoin\Message\PurchaseRequest', $request);
        $this -> assertSame('10.00', $request -> getAmount());
    }

    public function testStatusRequest()
    {
        $request = $this -> gateway -> status(array('invoiceId' => 'abc123'));

        $this -> assertInstanceOf('Omnipay\GoCoin\Message\FetchTransactionRequest', $request);
        $this -> assertSame('abc123', $request -> getTransactionReference());
    }
*/
}
