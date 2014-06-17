<?php

namespace Omnipay\GoCoin\Message;

use Omnipay\Omnipay;
use Omnipay\Tests\TestCase;

class AuthorizeRequestTest extends TestCase
{
    const TEST_MODE     = FALSE;
    const CLIENT_ID     = 'clientId';
    const CLIENT_SECRET = 'clientSecret';
    const REDIRECT_URI  = "redirectUri";
    const CODE          = "code";

    public function setUp()
    {
        $this -> request = new AuthorizeRequest($this -> getHttpClient(), $this -> getHttpRequest());
        $this -> request -> initialize(
            array(
                'testMode' => AuthorizeRequestTest::TEST_MODE,
                'clientId' => AuthorizeRequestTest::CLIENT_ID,
                'clientSecret' => AuthorizeRequestTest::CLIENT_SECRET,
                'redirectUri' => AuthorizeRequestTest::REDIRECT_URI,
                'code' => AuthorizeRequestTest::CODE,
            )
        );
    }

    public function testGetData()
    {
        $this -> request -> initialize(
            array(
                'testMode' => AuthorizeRequestTest::TEST_MODE,
                'clientId' => AuthorizeRequestTest::CLIENT_ID,
                'clientSecret' => AuthorizeRequestTest::CLIENT_SECRET,
                'redirectUri' => AuthorizeRequestTest::REDIRECT_URI,
                'code' => AuthorizeRequestTest::CODE,
            )
        );
        $data = $this -> request -> getData();
        $this -> assertSame($this -> request -> getCode(), $data['code']);
        $this -> assertSame($this -> request -> getClientId(), $data['client_id']);
        $this -> assertSame($this -> request -> getClientSecret(), $data['client_secret']);
        $this -> assertSame($this -> request -> getRedirectUri(), $data['redirect_uri']);
        return $data;
    }

    public function testDontSendData()
    {
        $data = $this -> testGetData();
        $response = $this -> request -> sendData($data,false);
        $this -> assertFalse($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertNull($response -> getData());
        $this -> assertNull($response -> getMessage());
        $this -> assertNull($response -> getRedirectUrl());
        $this -> assertNull($response -> getRedirectData());
        $this -> assertSame('GET', $response -> getRedirectMethod());
    }

    public function testDontSendDataToTest()
    {
        $data = $this -> testGetData();
        $this -> request -> setTestMode(!(AuthorizeRequestTest::TEST_MODE));
        $response = $this -> request -> sendData($data,false);
        $this -> assertFalse($response -> isSuccessful());
    }

    public function testGetAuthCodeUrl()
    {
        //create an omnipay gateway for gocoin
        $gateway = Omnipay::create('GoCoin');
        //setup some auth params
        $params = array(
          'testMode' => AuthorizeRequestTest::TEST_MODE,
          'clientId' => AuthorizeRequestTest::CLIENT_ID,
          'redirectUri' => AuthorizeRequestTest::REDIRECT_URI,
        );
        //get the auth code url
        $url = $gateway -> getAuthCodeUrl($params);
        $this -> assertSame(
          $url,
          'https://dashboard.gocoin.com/auth?response_type=code&client_id=clientId&redirect_uri=redirectUri&scope=user_read+invoice_read_write'
        );
    }
}
