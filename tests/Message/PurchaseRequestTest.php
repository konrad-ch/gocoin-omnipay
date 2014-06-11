<?php

namespace Omnipay\GoCoin\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    const TEST_MODE     = FALSE;
    const TOKEN         = 'TOKEN';
    const MERCHANT_ID   = "MERCHANT";

    public function setUp()
    {
        $this -> request = new PurchaseRequest($this -> getHttpClient(), $this -> getHttpRequest());
        $this -> request -> initialize(
            array(
                'testMode' => PurchaseRequestTest::TEST_MODE,
                'token' => PurchaseRequestTest::TOKEN,
                'amount' => '1.00',
                'currency' => 'USD',
                'itemName' => 'Another Item',
                'itemSku' => '123456',
            )
        );
    }

    public function testGetData()
    {
        $this -> request -> initialize(
            array(
                'testMode' => PurchaseRequestTest::TEST_MODE,
                'token' => PurchaseRequestTest::TOKEN,
                'merchantId' => PurchaseRequestTest::MERCHANT_ID,
                'amount' => '1.00',
                'currency' => 'USD',
                'itemName' => 'Another Item',
                'itemSku' => '123456',
            )
        );
        $data = $this -> request -> getData();
        $this -> assertSame('1.00', $data['base_price']);
        $this -> assertSame('BTC', $data['price_currency']);
        $this -> assertSame('USD', $data['base_price_currency']);
        $this -> assertSame('all', $data['notification_level']);
        $this -> assertSame('Another Item', $data['item_name']);
        $this -> assertSame('123456', $data['item_sku']);
        return $data;
    }

    public function testGetDataAllParams()
    {
        $this -> request -> initialize(
            array(
                'testMode' => PurchaseRequestTest::TEST_MODE,
                'token' => PurchaseRequestTest::TOKEN,
                'merchantId' => PurchaseRequestTest::MERCHANT_ID,
                'amount' => '1.00',
                'notificationLevel' => 'all',
                'currency' => 'USD',
                'priceCurrency' => 'USD',
                'code' => 'code',
                'clientId' => 'clientId',
                'clientSecret' => 'clientSecret',
                'redirectUri' => 'redirectUri',
                'callbackUri' => 'callbackUri',
                'confirmationsRequired' => 'confirmationsRequired',
                'paymentAddress' => 'paymentAddress',
                'serviceFeeRate' => 'serviceFeeRate',
                'usdSpotRate' => 'usdSpotRate',
                'spotRate' => 'spotRate',
                'inverseSpotRate' => 'inverseSpotRate',
                'cryptoPayoutSplit' => 'cryptoPayoutSplit',
                'orderId' => 'orderId',
                'itemName' => 'itemName',
                'itemSku' => 'itemSku',
                'itemDescription' => 'itemDescription',
                'physical' => 'physical',
                'customerName' => 'customerName',
                'customerAddress1' => 'customerAddress1',
                'customerAddress2' => 'customerAddress2',
                'customerCity' => 'customerCity',
                'customerRegion' => 'customerRegion',
                'customerCountry' => 'customerCountry',
                'customerPostalCode' => 'customerPostalCode',
                'customerEmail' => 'customerEmail',
                'customerPhone' => 'customerPhone',
                'userDefined1' => 'userDefined1',
                'userDefined2' => 'userDefined2',
                'userDefined3' => 'userDefined3',
                'userDefined4' => 'userDefined4',
                'userDefined5' => 'userDefined5',
                'userDefined6' => 'userDefined6',
                'userDefined7' => 'userDefined7',
                'userDefined8' => 'userDefined8',
            )
        );
        $data = $this -> request -> getData();
        $this -> request -> setParam('foo', 'bar');
        $this -> request -> addParameter(null, 'test', 'test');
        $this -> request -> addParameter($data, 'testMode', 'test_mode');
        $this -> request -> addParameter($data, 'foo', 'foo');
        $this -> assertSame($this -> request -> getCallbackUri(), $data['callback_url']);
        $this -> assertSame($this -> request -> getNotificationLevel(), $data['notification_level']);
        $this -> assertSame($this -> request -> getConfirmationsRequired(), $data['confirmations_required']);
        $this -> assertSame($this -> request -> getPriceCurrency(), $data['price_currency']);
        $this -> assertSame($this -> request -> getPaymentAddress(), $data['payment_address']);
        $this -> assertSame($this -> request -> getServiceFeeRate(), $data['service_fee_rate']);
        $this -> assertSame($this -> request -> getUsdSpotRate(), $data['usd_spot_rate']);
        $this -> assertSame($this -> request -> getSpotRate(), $data['spot_rate']);
        $this -> assertSame($this -> request -> getInverseSpotRate(), $data['inverse_spot_rate']);
        $this -> assertSame($this -> request -> getCryptoPayoutSplit(), $data['crypto_payout_split']);
        $this -> assertSame($this -> request -> getOrderId(), $data['order_id']);
        $this -> assertSame($this -> request -> getItemName(), $data['item_name']);
        $this -> assertSame($this -> request -> getItemSku(), $data['item_sku']);
        $this -> assertSame($this -> request -> getItemDescription(), $data['item_description']);
        $this -> assertSame($this -> request -> getPhysical(), $data['physical']);
        $this -> assertSame($this -> request -> getCustomerName(), $data['customer_name']);
        $this -> assertSame($this -> request -> getCustomerAddress1(), $data['customer_address_1']);
        $this -> assertSame($this -> request -> getCustomerAddress2(), $data['customer_address_2']);
        $this -> assertSame($this -> request -> getCustomerCity(), $data['customer_city']);
        $this -> assertSame($this -> request -> getCustomerRegion(), $data['customer_region']);
        $this -> assertSame($this -> request -> getCustomerCountry(), $data['customer_country']);
        $this -> assertSame($this -> request -> getCustomerPostalCode(), $data['customer_postal_code']);
        $this -> assertSame($this -> request -> getCustomerEmail(), $data['customer_email']);
        $this -> assertSame($this -> request -> getCustomerPhone(), $data['customer_phone']);
        $this -> assertSame($this -> request -> getUserDefined1(), $data['user_defined_1']);
        $this -> assertSame($this -> request -> getUserDefined1(), $data['user_defined_1']);
        $this -> assertSame($this -> request -> getUserDefined2(), $data['user_defined_2']);
        $this -> assertSame($this -> request -> getUserDefined3(), $data['user_defined_3']);
        $this -> assertSame($this -> request -> getUserDefined4(), $data['user_defined_4']);
        $this -> assertSame($this -> request -> getUserDefined5(), $data['user_defined_5']);
        $this -> assertSame($this -> request -> getUserDefined6(), $data['user_defined_6']);
        $this -> assertSame($this -> request -> getUserDefined7(), $data['user_defined_7']);
        $this -> assertSame($this -> request -> getUserDefined8(), $data['user_defined_8']);
//var_dump($data);
    }

    public function testDontSendData()
    {
        $this -> request -> initialize(
            array(
                'testMode' => PurchaseRequestTest::TEST_MODE,
                'token' => PurchaseRequestTest::TOKEN,
                'amount' => '1.00',
                'currency' => 'USD',
                'itemName' => 'Another Item',
                'itemSku' => '123456',
            )
        );
        $mockUserHttpResponse = $this -> getMockHttpResponse('UserSuccess.txt');
        $data = $this -> request -> getData(false,$mockUserHttpResponse);
        $response = $this -> request -> sendData($data,false);
        $this -> assertFalse($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertNull($response -> getMessage());
    }

/*
    public function testSendFailure()
    {
        $this -> setMockHttpResponse('PurchaseFailure.txt');
        $response = $this -> request -> send();

        $this -> assertFalse($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertSame("Name can't be blank", $response -> getMessage());
        $this -> assertNull($response -> getRedirectUrl());
        $this -> assertNull($response -> getRedirectData());
        $this -> assertSame('c777f2ca6e01b8c116b267a053603e62', $response -> getTransactionReference());
    }

    public function testSendUnauthorized()
    {
        $this -> setMockHttpResponse('PurchaseUnauthorized.txt');
        $response = $this -> request -> send();

        $this -> assertFalse($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertSame('ACCESS_SIGNATURE does not validate', $response -> getMessage());
        $this -> assertNull($response -> getRedirectUrl());
        $this -> assertNull($response -> getRedirectData());
        $this -> assertNull($response -> getTransactionReference());
    }
*/
}
