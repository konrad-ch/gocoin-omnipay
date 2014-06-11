<?php

namespace Omnipay\GoCoin\Message;

use Omnipay\Tests\TestCase;

class StatusRequestTest extends TestCase
{
    const TEST_MODE     = FALSE;
    const INVOICE_ID    = "079baed6-b8bd-4f19-a274-e23a1964dbef";
    const TOKEN         = 'TOKEN';

    public function setUp()
    {
        $this -> httpRequest = $this -> getHttpRequest();
        $this -> request = new StatusRequest($this -> getHttpClient(), $this -> httpRequest);
        $this -> request -> initialize(
            array(
              'testMode' => StatusRequestTest::TEST_MODE,
              'token' => $token,
              'invoiceId' => StatusRequestTest::INVOICE_ID,
            )
        );
    }

    public function testGetDataGet()
    {
        $this -> request -> initialize(
            array(
              'testMode' => StatusRequestTest::TEST_MODE,
              'token' => $token,
              'invoiceId' => StatusRequestTest::INVOICE_ID,
            )
        );
        $data = $this -> request -> getData();
        $this -> assertSame(StatusRequestTest::INVOICE_ID, $data['id']);
    }

    public function testSendSuccess()
    {
        $this -> setMockHttpResponse('StatusRequestSuccess.txt');
        $response = $this -> request -> send();

        $this -> assertTrue($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertSame('completed', $response -> getMessage());
        $this -> assertSame('9XMWP4YG', $response -> getTransactionReference());
    }

    public function testSendFailure()
    {
        $this -> httpRequest -> request -> replace(
            array(
              'testMode' => StatusRequestTest::TEST_MODE,
              'token' => $token,
              'invoiceId' => StatusRequestTest::INVOICE_ID . '_BAD',
            )
        );
        $this -> setMockHttpResponse('StatusRequestFailure.txt');
        $response = $this -> request -> send();

        $this -> assertFalse($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertSame('Order not found with that id', $response -> getMessage());
        $this -> assertNull($response -> getTransactionReference());
    }
}
